<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Str;
use App\Custom\SanitizeInput;
use Auth;
use Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\UploadedContact;

class ContactController extends Controller
{
    function __construct(){
        $this->clean = new SanitizeInput;
    }

    function index(){
        $contacts = $data['contacts'] = Contact::where('user_id', Auth::user()->id)->get();
        return view('contacts.list')->with($data);
    }

    function create(){
        return view('contacts.create');
    }

    function save(Request $request){
        $request->validate([
            'title'=>'required',
            'numbers'=>'required'
        ]);
        // dd($request);
        $contact = new Contact;
        $contact->title = $this->clean->sanitizeInput($request->title);
        $contact->numbers = $this->clean->sanitizeInput($request->numbers);
        $contact->slug =str_replace(' ', '_',  $this->clean->sanitizeInput($request->title)).'_'.Str::random(12);
        $contact->user_id = Auth::user()->id;
        $contact->save();

        Session(['msg'=>'Contact Saved', 'alert'=>'success']);

        return redirect()->route('contact-detail', $contact->slug);

    }

    function detail(Request $request){
         $data['contact'] = $contact = Contact::where(['slug'=>$request->slug, 'user_id'=>Auth::user()->id])->first();
         if (empty($contact->file)) {
             $data['numbers'] = $explodeContact = explode(',', $contact->numbers);
             if (!empty($contact->names)) {
                 $data['names'] = $explodeContact = explode(',', $contact->names);
             }
             return view('contacts.detail')->with($data);
         }else{

            $filePath = public_path('storage/contacts/' .$contact->file);
            // Reading file
            $file = fopen($filePath, "r");
            $importData_arr = array(); // Read through the file and store the contents as an array
            $i = 0;


            //Read the contents of the uploaded file 
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata);
                // Skip first row (Remove below comment if you want to skip the first row)
                // if ($i == 0) {
                // $i++;
                // continue;
                // }
                for ($c = 0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata[$c];
                }
                $i++;
            }
            fclose($file); //Close after reading
            // dd($importData_arr);

            $headRow = $data['headRow'] = $importData_arr[0];
            unset($importData_arr[0]);
            $bodyRow = $data['bodyRow'] = $importData_arr;

            Session(['headRow'=>$headRow, 'body'=>$bodyRow]);
            return view('contacts.detail_csv')->with($data);
         }
         
    }

    function editNumber(Request $request){
        $request->validate([
            'number'=>'required'
        ]);
        $contact_id = $this->clean->sanitizeInput($request->contact_id);
        $oldNumber = $this->clean->sanitizeInput($request->old_number);
        $newNumber = $this->clean->sanitizeInput($request->number);
        $contact = Contact::where('id', $contact_id)->first();
        if ($request->name) {

            $newName = $this->clean->sanitizeInput($request->name);
        }
        $explodeContact = explode(',', $contact->numbers);
        // dd($oldNumber);
        if (in_array($oldNumber, $explodeContact)) {
            // dd('yes');
            // array_replace($oldNumber, $newNumber);
            $key = array_search($oldNumber, $explodeContact);
            $explodeContact[$key]=$newNumber;
            $contact->numbers = implode(',', $explodeContact);
            if (isset($newName)) {
                $explodeNames = explode(',', $contact->names);
                
                $explodeNames[$key] = $newName;
                $contact->names = implode(',', $explodeNames);
            }
            $contact->save();
            // Session(['msg'=>'Successful', 'alert'=>'success']);
            return json_encode(['status'=>'success', 'number'=>$newNumber, 'name'=>isset($newName)?$newName:'']);
            // return redirect()->back();
        }else{
            return json_encode(['status'=>'fail', 'msg'=>'Oops! Not found']);
            // Session(['msg'=>'Oops! Not found', 'alert'=>'danger']);
            // return redirect()->back();
        }

    } 


    function deleteNumber(Request $request){
        $contact_id = $this->clean->sanitizeInput($request->contact_id);
        $oldNumber = $this->clean->sanitizeInput($request->number);
        $contact = Contact::where('id', $contact_id)->first();
        $explodeContact = explode(',', $contact->numbers);
        // dd($oldNumber);
        if (in_array($oldNumber, $explodeContact)) {
            // array_replace($oldNumber, $newNumber);
            $key = array_search($oldNumber, $explodeContact);
            unset($explodeContact[$key]);
            // dd($explodeContact);
            $contact->numbers = implode(',', $explodeContact);
            $contact->save();
            Session(['msg'=>'Successful', 'alert'=>'success']);
            return redirect()->back();
        }else{
            Session(['msg'=>'Oops! Not found', 'alert'=>'danger']);
            return redirect()->back();
        }

    }


    function rename(Request $request){
        $request->validate([
            'contact_slug'=>'required',
            'title'=>'required'
        ]);
        $contact = Contact::where('slug', $this->clean->sanitizeInput($request->contact_slug))->first();
        if (is_null($contact)) {
           die('invalid resource');
        }else{
            $title = $this->clean->sanitizeInput($request->title);
            $contact->title = $title;
            $contact->save();
            Session(['msg'=>'Successful', 'alert'=>'success']);
            return redirect()->back();
        }
    }


    function addNumbers(Request $request){
        $request->validate([
            'contact_slug'=>'required',
            'numbers'=>'required'
        ]);
        // dd($request);
        $contact = Contact::where('slug', $this->clean->sanitizeInput($request->contact_slug))->first();
        $newNumbers = $this->clean->sanitizeInput($request->numbers);
        
        $oldNumbers = $contact->numbers;

        $numbersToSave  = array_merge(explode(',', $oldNumbers), explode(',', $newNumbers));
        $contact->numbers = implode(',', $numbersToSave);
        // $contact->numbers = 
        $contact->save();

        Session(['msg'=>'Contact updated', 'alert'=>'success']);

        return redirect()->route('contact-detail', $contact->slug);

    }

    function delete(Request $request){
        $request->validate([
            'contact_slug'=>'required',
        ]);
        $contact = Contact::where('slug', $this->clean->sanitizeInput($request->contact_slug))->delete();
        
        Session(['msg'=>'Deleted', 'alert'=>'success']);
        return redirect()->route('contacts');
    }

    function upload(Request $request){
        $data = $request->validate([
            'contact'=>'required|mimes:csv,txt|max:10240',
            'title'=>'required|string',
        ]);

        $contact         = $request->file('contact');

        $contactName = $contact->getClientOriginalName();
        $contactExt = $contact->getClientOriginalExtension();
        $contactName = pathinfo($contact, PATHINFO_FILENAME);
        $contactToDb = $contactName . '_' . time() . '.' . $contactExt;
        $savecontact = $contact->storeAs('public/contacts', $contactToDb);

        $newContact = new Contact;
        $newContact->title = $this->clean->sanitizeInput($request->title);
        $newContact->file = $contactToDb;
        $newContact->slug =str_replace(' ', '_',  $this->clean->sanitizeInput($request->title)).'_'.Str::random(12);
        $newContact->user_id = Auth::user()->id;

        $newContact->save();

        $filePath = public_path('storage/contacts/'.$newContact->file);
        // Reading file
        $file = fopen($filePath, "r");
        $importData_arr = array(); // Read through the file and store the contents as an array
        $i = 0;

        //Read the contents of the uploaded file 
        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
            $num = count($filedata);
            // Skip first row (Remove below comment if you want to skip the first row)
            // if ($i == 0) {
            // $i++;
            // continue;
            // }
            for ($c = 0; $c < $num; $c++) {
            $importData_arr[$i][] = $filedata[$c];
            }
            $i++;
        }
        fclose($file); //Close after reading
        // dd($importData_arr);

        // $headRow = $data['headRow'] = $importData_arr[0];
        // foreach ($headRow as $key => $tableHead) {
        //     Schema::table('uploaded_contacts', function (Blueprint $table){
        //         $table->string($tableHead);
        //     });
        // }
        

        // dd('yes');
        // unset($importData_arr[0]);
        // $bodyRow = $data['bodyRow'] = $importData_arr;
        // foreach ($bodyRow as $rowKey => $tabeleRow) {
        //     $uploadedContact = new UploadedContact;
        //     $uploadedContact->id = $contact->id;

        //     foreach ($headRow as $headKey => $tableHead) {

        //         $uploadedContact->tableHead = $tabeleRow[$headKey];
        //     }

        //     $uploadedContact->save();
        // }
        
        // dd($uploadedContact);
        

        Session(['msg'=>'Contact saved', 'alert'=>'success']);
        return redirect()->route('contact-detail', $newContact->slug);

    }

    public function renamePhoneColumn(Request $request){
        $request->validate([
            'contact_slug'=>'required',
            'old_name'=>'required'
        ]);

        Session([
            'old_phone_column'=>$this->clean->sanitizeInput($request->old_name),
            'phone_index'=>$this->clean->sanitizeInput($request->index),
            'msg'=>'One more step (optional).', 
            'alert'=>'success'
        ]);

        return redirect()->back();


        // $contact = Contact::where('slug', $this->clean->sanitizeInput($request->slug))->first();
        // $filePath = public_path('storage/contacts/' .$contact->file);
        //     // Reading file
        //     $file = fopen($filePath, "r");
        //     $importData_arr = array(); // Read through the file and store the contents as an array
        //     $i = 0;


        //     //Read the contents of the uploaded file 
        //     while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
        //         $num = count($filedata);
        //         // Skip first row (Remove below comment if you want to skip the first row)
        //         // if ($i == 0) {
        //         // $i++;
        //         // continue;
        //         // }
        //         for ($c = 0; $c < $num; $c++) {
        //         $importData_arr[$i][] = $filedata[$c];
        //         }
        //         $i++;
        //     }
        //     fclose($file); //Close after reading
        //     // dd($importData_arr);

        //     $headRow = $data['headRow'] = $importData_arr[0];
            
    }

    public function renameNameColumn(Request $request){
        $request->validate([
            'contact_slug'=>'required',
            'old_name'=>'required'
        ]);

         // Session(['headRow'=>$headRow, 'body'=>$bodyRow]);
        // Get contact instance on DB
        $contact = Contact::where('slug', $this->clean->sanitizeInput($request->contact_slug))->first();
        // get the formal name of the column being renamed to "Name"
        $oldNameColumn = $this->clean->sanitizeInput($request->old_name);
        // Get the array index of the column being renamed to "Name"
        $nameIndex = $this->clean->sanitizeInput($request->index);
        // Initiate an array variabke to carry phone numbers
        $numberArr = [];
        // Initiate an array variabke to carry contact names
        $nameArr = [];
        // Loop through the bodyRow session property created in $this->detail()
        foreach (session('body') as $key => $bodyRow) {
            if (!empty($bodyRow[session('phone_index')])) {
                
                 // get the phone number from each body row using the session('phone_index') created in the function here we renamed the phone column
                array_push($numberArr, $bodyRow[session('phone_index')]);

                // get the names from each body row using the nameIndex variable declared and above in this function
                array_push($nameArr, $bodyRow[$nameIndex]);
            }
           
        };

        $contact->numbers = implode(',', $numberArr);
        $contact->names = implode(',', $nameArr);

        // look out for the uploaded csv file on the storge folder
        if (file_exists('.' . Storage::url('app/public/contacts/' .$contact->file)) && is_file('.' . Storage::url('app/public/contacts/' .$contact->file))) {
            // if it exists, delete it
            unlink('.' . Storage::url('app/public/contacts/' .$contact->file));
        }
        $contact->file = NULL;
        $contact->save();
        Session(['msg'=>'Contact upload completed', 'alert'=>'success']);
        session()->forget(['body', 'phone_index', 'old_phone_column', 'headRow']);
                    
        return redirect()->route('contact-detail', $contact->slug);

    }   


     public function skipNameColumn(Request $request){
       
         // Session(['headRow'=>$headRow, 'body'=>$bodyRow]);
        // Get contact instance on DB
        $contact = Contact::where('slug', $this->clean->sanitizeInput($request->slug))->first();
        
        
        // Initiate an array variabke to carry phone numbers
        $numberArr = [];
       
        // Loop through the bodyRow session property created in $this->detail()
        foreach (session('body') as $key => $bodyRow) {
            if (!empty($bodyRow[session('phone_index')])) {
                
                 // get the phone number from each body row using the session('phone_index') created in the function here we renamed the phone column
                array_push($numberArr, $bodyRow[session('phone_index')]);

            }
           
        };

        $contact->numbers = implode(',', $numberArr);
        

        // look out for the uploaded csv file on the storge folder
        if (file_exists('.' . Storage::url('app/public/contacts/' .$contact->file)) && is_file('.' . Storage::url('app/public/contacts/' .$contact->file))) {
            // if it exists, delete it
            unlink('.' . Storage::url('app/public/contacts/' .$contact->file));
        }
        $contact->file = NULL;
        $contact->save();
        Session(['msg'=>'Contact upload completed', 'alert'=>'success']);
        session()->forget(['body', 'phone_index', 'old_phone_column', 'headRow']);
                    
        return redirect()->route('contact-detail', $contact->slug);

    }   
}
