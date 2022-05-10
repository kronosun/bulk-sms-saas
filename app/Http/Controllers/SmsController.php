<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Str;

use Auth;
use App\Contact;
use App\MessageContact;
use DB;
use App\MessageSchedule;
use App\Custom\SendMessage;

class SmsController extends Controller
{
    function __construct(){
        
        $this->sendMessage = new SendMessage;
    }

    public function compose(){
        $message = new Message;
        $message->slug = Str::random(30);
        $message->user_id= Auth::user()->id;
        // $message->title= clean($request->title);
        // $message->content= clean($request->content);
        
        $message->save();
        return redirect()->route('edit-message', $message->slug);
    }

    public function save(Request $request){
        if (empty($request->slug)) {
            $message = new Message;
            $message->slug = Str::random(30);
            $message->user_id= Auth::user()->id;
        }else{
            $message = Message::where('slug', clean($request->slug))->first();
        }
        $message->title= clean($request->title);
        $message->content= clean($request->content);
        
        $message->save();
        return $message->slug;
        
    }


    public function sendComposed(Request $request){
       
        $msgSlug = clean($request->slug);

        $message = Message::where('slug', $msgSlug)->first();

        $charLen = strlen($message->content);
        // return $charLen;
        $countFactor = $charLen/150;
        // return (float)$countFactor;
        $countFactorStr = strval((float)$countFactor);
        $countSplit = explode('.', $countFactorStr);

        $wholeNo = $countSplit[0];
        if (count($countSplit)>1) {
            $addFactor = 1;
        }else{
            $addFactor = 0;
        }
        
        $pageCount = (int)$wholeNo + $addFactor;

         // generate a reference (for local simulation purpose only);
        $gatewayMsgRef =Str::random(10);

        if ($request->numbers) {
            $numbers = clean($request->numbers);
            
            $title = 'Untitled '.Str::random(4);
            // save numbers first
            $contact = new Contact;
           
            $numArr = explode(',', $numbers);
            $requiredUnits = count($numArr) * $pageCount;
            $capacity = floor(Auth::user()->units->sum('available_units')/$pageCount);
            // return count($numAr r* $pageCount);
            
            foreach ($numArr as $key => $num) {

                    $first3 = substr($num, 0, 3);
                    if ($first3!='234') {
                        $num = '234'.ltrim($num, $num[0]);
                    }

                    $numArr[$key] = $num;
                
            }
            
            $contact->numbers = implode(',', $numArr);
            // return $numArr;
            $contact->title = $title;
            $contact->slug = $contact->slug =str_replace(' ', '_',  $title).'_'.Str::random(12);
            $contact->user_id = Auth::user()->id;
            $contact->save();


            $sendArr = explode(',', $contact->numbers);
            $sendArr = array_slice($sendArr, 0, $capacity);
            $requiredUnits  = count($sendArr) * $pageCount;
            if ($requiredUnits>Auth::user()->units->sum('available_units')) {
                // call the send message class
                // $sendNow = 'ooo';

                $messageContact = new MessageContact;

                $messageContact->message_id = $message->id;
                $messageContact->contact_id = $request->contacts?$contact:$contact->id;
                $messageContact->status = '1';
                $messageContact->gateway_ref = $gatewayMsgRef;
                $message->sent_at = time();
                $messageContact->save();

                $message->status = '1';
                $message->save();

                $sendNow = $this->sendMessage->sendMulti($sendArr, $message->content, $requiredUnits, Auth::user()->id, $message->id);
                $response = json_decode($sendNow);
                if (property_exists($sendNow, 'error') && $sendNow->error!='') {
                    return json_encode(['status'=>'fail', 'message_status'=>'not sent', 'msg_slug'=>$message->slug, 'response'=>$sendNow]);
                }

                Session(['msg'=>'sending in progress', 'alert'=>'success']);
                return json_encode(['status'=>'success', 'message_status'=>'sending in progress', 'msg_slug'=>$message->slug, 'response'=>$sendNow]);
            }else{
                return json_encode(['status'=>'fail', 'message'=>'insufficient credits']);
            }
            

        }

        if ($request->contacts){

            // return $request->contacts;
            $unitCount = floor(Auth::user()->units->sum('available_units'));
            $sendArr = [];
            $unitsToDeduct = 0;
            $cc = 0;

            // return $request->contacts;

            foreach($request->contacts as $contact_id){
                $cc ++;
                $contact = Contact::where('id', $contact_id)->first();
                $numArr = explode(',', $contact->numbers);

                $numberCount = count($numArr);
                $requiredUnits  = $numberCount * $pageCount;
                $capacity = floor($unitCount/$pageCount);
                if ($requiredUnits>$unitCount) {
                    
                    $pushNum = array_slice($numArr, 0, $capacity);
                    // if ($cc==3) {
                    //     dd( $capacity);
                    // }
                    // $capacity * $pageCount
                    // return $pushNum;
                    $sendArr = array_merge($pushNum, $sendArr);
                    $unitCount = $unitCount - $requiredUnits;
                    $unitsToDeduct= $unitsToDeduct + ($capacity * $pageCount);
                    $break = 'yes';

                    // return $sendArr;
                    
                    // break;
                }else{
                    
                    foreach ($numArr as $num) {
                        array_push($sendArr, $num);
                    }
                    $unitCount = $unitCount - $requiredUnits;
                    $unitsToDeduct= $unitsToDeduct + $requiredUnits;
                }
                
                // if ($cc==3) {
                //     dd($requiredUnits);
                // }
                
                // echo $cc.' - num_cont :'. count($sendArr).' - required  units: '. $unitsToDeduct.' avalable units - '.$unitCount;
                // echo '<br>';
               // echo $unitsToDeduct;

               
                $message = Message::where('slug', clean($request->slug))->first();

               
                $messageContact = new MessageContact;

                $messageContact->message_id = $message->id;
                $messageContact->contact_id =$contact->id;
                $messageContact->status = '1';
                $messageContact->gateway_ref = $gatewayMsgRef;
                $message->sent_at = time();
                $messageContact->save();

                $message->status = '1';
                $message->save();

                if (isset($break)) {
                    // return $unitsToDeduct;
                    break;
                }

            }
            // return;

            // return $sendArr;

             // call the send message class
            // return 'yes';
            $sendNow = $this->sendMessage->sendMulti($sendArr, $message->content, $unitsToDeduct, Auth::user()->id, $message->id);
            if (property_exists($sendNow, 'error') && $sendNow->error!='') {
                    return json_encode(['status'=>'fail', 'message_status'=>'not sent', 'msg_slug'=>$message->slug, 'response'=>$sendNow]);
                }

                Session(['msg'=>'sending in progress', 'alert'=>'success']);
                return json_encode(['status'=>'success', 'message_status'=>'sending in progress', 'msg_slug'=>$message->slug, 'response'=>$sendNow]);
        }
        

    }

    public function feedback(Request $request){
        $status = clean($request->status);
        $feedbackMessage = clean($request->feedbackMessage);

        $messageContacts = MessageContact::where('gateway_ref', clean($request->gateway_ref))->get();
        
        // $message = $message = Message::where('gateway_ref', clean($request->gateway_ref))->first();
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
        $messages = $data['messages'] = Message::where('user_id', Auth::user()->id)->where('status', '>=', '1')->where('status', '<=', '3')->with('contacts')->with('messageStatus')->latest()->get();

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
        $messages = $data['messages'] = Message::where('user_id', Auth::user()->id)->where('status', '=', '0')->latest()->get();
        return view('sms.draft')->with($data);
    }
    public function edit(Request $request){
        if ($request->action) {
            $data['action']=clean($request->action);
        }
        $message = $data['message'] = Message::where('slug', clean($request->slug))->first();
        return view('sms.edit')->with($data);
    }

    public function delete(Request $request){
        $message = Message::where('slug', clean($request->message_slug))->first();
        if (is_null($message)) {
             return json_encode(['status'=>'fail', 'msg'=>'Message not found', 'alert'=>'warning']);
        }else{
            Message::where('slug', $request->message_slug)->delete();
            return json_encode(['status'=>'success', 'msg'=>'Deleted', 'alert'=>'success']);
        }
        
    }

    public function schedule(Request $request){
         if ($request->action) {
            if (clean($request->action)=='modify_schedule') {
                MessageSchedule::where('message_id', clean($request->msgId))->delete();
            }
            
        }
        
        $fulldate = clean($request->fulldate);
        $message = Message::where('slug', clean($request->slug))->first();
        $time = strtotime(clean($request->fulldate));
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
            $numbers = clean($request->numbers);
            

           
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
        $messages = $data['messages'] = Message::where('user_id', Auth::user()->id)->where('status', '>=', '4')->where('status', '<=', '5')->with('schedule')->latest()->get();
       // foreach ($messages as $key => $message) {
       //    dd($message->schedule()->first()->contact);
       // }

        return view('sms.scheduled')->with($data);
    }

    public function deleteScheduled(Request $request){
        $schedule = MessageSchedule::where('message_id', clean($request->message_id))->first();
        if (is_null($schedule)) {
            return json_encode(['status'=>'fail', 'msg'=>'Schedule not found', 'alert'=>'warning']);
        }else{
            $message = Message::where('id', clean($request->message_id))->first();
            MessageSchedule::where('message_id', clean($request->message_id))->delete();
            $message->status = '5';
            $message->save();
            return json_encode(['status'=>'success', 'msg'=>'Schedule Cancelled', 'alert'=>'success']);
        }
    }
}