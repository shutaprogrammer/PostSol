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
        $reports = Report::with('user', 'post')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.reports', compact('reports'));
    }

    public function exchange()
    {
        $gifts = Amazon::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.exchange', compact('gifts'));
    }


    public function inbox()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(9);

        return view('admin.inbox', compact('contacts'));
    }

    public function unread()
    {
        $contacts = Contact::where('status', '未')->paginate(9);

        return view('admin.inbox', compact('contacts'));
    }

    public function inprogress()
    {
        $contacts = Contact::where('status', '対応中')->paginate(9);

        return view('admin.inbox', compact('contacts'));
    }

    public function complete()
    {
        $contacts = Contact::where('status', '完了')->paginate(9);

        return view('admin.inbox', compact('contacts'));
    }


}
