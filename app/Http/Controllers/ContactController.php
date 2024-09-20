<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Contact;

class ContactController extends Controller
{
    public function form()
    {
        $user = Auth::user();

        return view('contact.form', ['user'=> $user]);
    }

    public function confirm(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
        'email' => 'required|email',
        'category' => 'required',
        'title' => 'required',
        'detail' => 'required',
        ]);

        $email = $request->input('email');
        $category = $request->input('category');
        $title = $request->input('title', '');
        $detail = $request->input('detail');
        


        return view('contact.confirm', compact('email', 'category', 'title', 'detail'));
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'category' => 'required',
            'title' => 'required',
            'detail' => 'required',
        ]);

        $email = $request->input('email');
        $category = $request->input('category');
        $title = $request->input('title', '');
        $detail = $request->input('detail');

        $contact = new Contact;
        $contact->user_id = Auth::id();
        $contact->email = $email;
        $contact->category = $category;
        $contact->title = $title;
        $contact->detail = $detail;

        $contact->save(); 

        return redirect()->route('contact.complete');
        
    }

    public function complete()
    {
        return view('contact.complete');
    }

    public function status(Request $request, $id)
    {
        $contact = Contact::find($id);
        $contact -> status = $request -> input('status');
        $contact->save();

        return redirect()->route('admin.inbox');
    }

}
