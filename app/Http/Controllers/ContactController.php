<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\ContactForm;

class ContactController extends Controller
{
           
    public function AdminContact(){
        $contacts = Contact::all();
        return view('admin.contact.index',compact('contacts'));
    }

    public function AdminAddContact(){
        return view('admin.contact.create');
    }

    public function AdminStoreContact(Request $request){

        Contact::insert([
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'created_at' => Carbon::now()

        ]);
        return redirect()->route('admin.contact')->with('success','Contact Inserted Successfully');
    }

    public function Contact(){
        $contacts = DB::table('contacts')->first();
        return view('pages.contact',compact('contacts'));
    }

    public function ContactForm(Request $request){
        ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now()

        ]);
        return redirect()->route('contact')->with('success','Your Message Sent Successfully');
    }

    public function  AdminMessage(){
        $messages = ContactForm::all();
        return view('admin.contact.message',compact('messages'));
    }
}
