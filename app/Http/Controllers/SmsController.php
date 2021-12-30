<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Str;
use App\Custom\SanitizeInput;
use Auth;
use App\Contact;
use App\MessageContact;
use DB;
use App\MessageSchedule;

class SmsController extends Controller
{
    function __construct(){
        $this->clean = new SanitizeInput;
    }

    public function compose(){
        $message = new Message;
        $message->slug = Str::random(30);
        $message->user_id= Auth::user()->id;
        // $message->title= $this->clean->sanitizeInput($request->title);
        // $message->content= $this->clean->sanitizeInput($request->content);
        
        $message->save();
        return redirect()->route('edit-message', $message->slug);
    }

    public function save(Request $request){
        if (empty($request->slug)) {
            $message = new Message;
            $message->slug = Str::random(30);
            $message->user_id= Auth::user()->id;
        }else{
            $message = Message::where('slug', $this->clean->sanitizeInput($request->slug))->first();
        }
        $message->title= $this->clean->sanitizeInput($request->title);
        $message->content= $this->clean->sanitizeInput($request->content);
        
        $message->save();
        return $message->slug;
        
    }

    public function sendComposed(Request $request){
        
        $msgSlug = $this->clean->sanitizeInput($request->slug);
         // generate a reference (for local simulation purpose only);
        $gatewayMsgRef =Str::random(10);

        if ($request->numbers) {
            $numbers = $this->clean->sanitizeInput($request->numbers);
            

           
            $title = 'Untitled '.Str::random(4);
            // save numbers first
            $contact = new Contact;
            $contact->numbers = $numbers;
            $contact->title = $title;
            $contact->slug = $contact->slug =str_replace(' ', '_',  $title).'_'.Str::random(12);
            $contact->user_id = Auth::user()->id;
            $contact->save();

            $message = Message::where('slug', $this->clean->sanitizeInput($request->slug))->first();

            $messageContact = new MessageContact;

            $messageContact->message_id = $message->id;
            $messageContact->contact_id = $request->contacts?$contact:$contact->id;
            $messageContact->status = '1';
            $messageContact->gateway_ref = $gatewayMsgRef;
            $messageContact->save();

            $message->status = '1';
            $message->save();
        }

        if ($request->contacts){
            foreach($request->contacts as $contact){
       
                $message = Message::where('slug', $this->clean->sanitizeInput($request->slug))->first();

                $messageContact = new MessageContact;

                $messageContact->message_id = $message->id;
                $messageContact->contact_id =$contact;
                $messageContact->status = '1';
                $messageContact->gateway_ref = $gatewayMsgRef;
                $message->sent_at = time();
                $messageContact->save();

                $message->status = '1';
                $message->save();
            }
        }
        Session(['msg'=>'sending in progress', 'alert'=>'success']);
        return json_encode(['status'=>'success', 'message_status'=>'sending in progress', 'msg_slug'=>$message->slug]);

    }

    public function feedback(Request $request){
        $status = $this->clean->sanitizeInput($request->status);
        $feedbackMessage = $this->clean->sanitizeInput($request->feedbackMessage);

        $messageContacts = MessageContact::where('gateway_ref', $this->clean->sanitizeInput($request->gateway_ref))->get();
        
        // $message = $message = Message::where('gateway_ref', $this->clean->sanitizeInput($request->gateway_ref))->first();
        $sentArray=[];
        $failedArr = [];
        // lop to get the message_contact instances 
        foreach ($messageContacts as $key => $messageContact) {
            // loop each message_contact_instance to get the contact groups
            foreach ($messageContact->contacts as $key => $contact) {
                // loop contact groups to get numbers
                foreach ($contact->numbers as $key => $number) {
                    if ($key%2==0) {
                        array_push($sentArray, $number);
                    }else{
                        array_push($failedArray, $number);
                    }
                }
               
            }
            
            $messageContact->sent = implode(',', $sentArray);
            $messageContact->failed = implode(',', $failedArray);
            $messageContact->status = '2';
            $messageContact->save(); 
        }
        
        return json_encode(['status'=>'success', 'message_status', 'sent', 'msg_slug'=>$message->slug]);
    }

    public function sent(){
        $messages = $data['messages'] = Message::where('user_id', Auth::user()->id)->where('status', '>=', '1')->where('status', '<=', '3')->with('contacts')->with('messageStatus')->get();

        // foreach ($messages as $key => $message) {
        //     dd($message->messageStatus->color);
        // }
       
        // $message = $data['messages'] = DB::table('messages')
        //                                 ->join('status_data', "messages.status", "=", "status_data.number")
        //                                 ->join('contact_message', "contact_message.message_id", "=", "messages.id")
        //                                 ->join('contacts', "contacts.id", "=", "contact_message.contact_id")
        //                                 ->select('messages.*', 'contacts.title as contact_title')
        //                                 ->where('messages.status',">=", '1')
        //                                 ->get();

         // $message = $data['messages'] = DB::table('contact_message')
         //                                ->join('messages', "contact_message.message_id", "=", "messages.id")
         //                                ->join('status_data', "messages.status", "=", "status_data.number")
         //                                ->join('contacts', "contacts.id", "=", "contact_message.contact_id")
         //                                ->select('contact_message.*', 'messages.*', 'messages.id as message_id', 'messages.title as message_title')
         //                                ->where('messages.status',">=", '1')
         //                                ->get();
        // dd($messages);

          // $data['farms'] = DB::table('farms')
          //   ->join('categories', "farms.farm_type", "=", "categories.id")
          //   // ->join('categories', "farms.farm_category","=","categories.id")
          //   ->select('farms.*', 'categories.*', 'categories.name as farmtype', 'categories.image as typeimage', 'farms.id as farm_id', 'farms.description as farmdescription')
          //   ->get();
        return view('sms.sent')->with($data);
    }

    public function draft(){
        $messages = $data['messages'] = Message::where('user_id', Auth::user()->id)->where('status', '=', '0')->get();
        return view('sms.draft')->with($data);
    }
    public function edit(Request $request){
        if ($request->action) {
            $data['action']=$this->clean->sanitizeInput($request->action);
        }
        $message = $data['message'] = Message::where('slug', $this->clean->sanitizeInput($request->slug))->first();
        return view('sms.edit')->with($data);
    }

    public function delete(Request $request){
        $message = Message::where('slug', $this->clean->sanitizeInput($request->message_slug))->first();
        if (is_null($message)) {
             return json_encode(['status'=>'fail', 'msg'=>'Message not found', 'alert'=>'warning']);
        }else{
            Message::where('slug', $request->message_slug)->delete();
            return json_encode(['status'=>'success', 'msg'=>'Deleted', 'alert'=>'success']);
        }
        
    }

    public function schedule(Request $request){
         if ($request->action) {
            if ($this->clean->sanitizeInput($request->action)=='modify_schedule') {
                MessageSchedule::where('message_id', $this->clean->sanitizeInput($request->msgId))->delete();
            }
            
        }
        $fulldate = $this->clean->sanitizeInput($request->fulldate);
        $message = Message::where('slug', $this->clean->sanitizeInput($request->slug))->first();
        $time = strtotime($this->clean->sanitizeInput($request->fulldate));
        if ($request->contacts){
            foreach($request->contacts as $contact){
                $schedule = new MessageSchedule;
                $schedule->date = $time;
                $schedule->message_id = $message->id;
                $schedule->contact_id= $contact;
                $schedule->save();
            }
        }
        if ($request->numbers) {
            $numbers = $this->clean->sanitizeInput($request->numbers);
            

           
            $title = 'Untitled '.Str::random(4);
            // save numbers first
            $contact = new Contact;
            $contact->numbers = $numbers;
            $contact->title = $title;
            $contact->slug = $contact->slug =str_replace(' ', '_',  $title).'_'.Str::random(12);
            $contact->user_id = Auth::user()->id;
            $contact->save();

            $schedule = new MessageSchedule;
            $schedule->date = $time;
            $schedule->message_id = $message->id;
            $schedule->contact_id= $contact->id;
            $schedule->save();
        }
        $message->status = '4';
        $message->save();
        Session(['status'=>'success', 'msg'=>'Schedule created']);
        return json_encode(['status'=>'success', 'msg'=>'Schdule created', 'alert'=>'success']);
    }

    public function scheduled(){
        $messages = $data['messages'] = Message::where('user_id', Auth::user()->id)->where('status', '>=', '4')->where('status', '<=', '5')->with('schedule')->get();
       // foreach ($messages as $key => $message) {
       //    dd($message->schedule()->first()->contact);
       // }

        return view('sms.scheduled')->with($data);
    }

    public function deleteScheduled(Request $request){
        $schedule = MessageSchedule::where('message_id', $this->clean->sanitizeInput($request->message_id))->first();
        if (is_null($schedule)) {
            return json_encode(['status'=>'fail', 'msg'=>'Schedule not found', 'alert'=>'warning']);
        }else{
            $message = Message::where('id', $this->clean->sanitizeInput($request->message_id))->first();
            MessageSchedule::where('message_id', $this->clean->sanitizeInput($request->message_id))->delete();
            $message->status = '5';
            $message->save();
            return json_encode(['status'=>'success', 'msg'=>'Schedule Cancelled', 'alert'=>'success']);
        }
    }
}