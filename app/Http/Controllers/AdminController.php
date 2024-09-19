<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Amazon;
use App\Models\Report;
use App\Models\Contact;




class AdminController extends Controller
{
    public function index()
    {
        return view('admin.menu');
    }

    public function reports()
    {
        $reports = Report::with('user', 'post')->get();

        return view('admin.reports', compact('reports'));
    }

    public function exchange()
    {
        $gifts = Amazon::all();
        return view('admin.exchange', compact('gifts'));
    }

    public function inbox()
    {
        $contacts = Contact::all();

        return view('admin.inbox', compact('contacts'));
    }


}
