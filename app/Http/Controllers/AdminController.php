<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Amazon;
use App\Models\Report;

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
        return view('admin.exchange',['gifts' => $gifts]);
    }

    public function inbox()
    {
        return view('admin.inbox');
    }
}
