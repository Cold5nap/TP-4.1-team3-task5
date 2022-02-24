<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
class ContactController extends Controller
{
    public function submit(ContactRequest $request)
    {
        $contact = new Contact();
        $contact->name=$request->input('name');
        $contact->email=$request->input('email');
        $contact->message=$request->input('message');
        $contact->subject=$request->input('subject');
        $contact->save();
        return redirect()->route('home')->with('success','Сообщение было добавлено.');
    }

    public function allData(){
        return view('user_message',['data'=>Contact::all()]);
    }

    public function showOneMessage($id){
        return view('one_user_message',['data'=>Contact::find($id)]);
    }
}
