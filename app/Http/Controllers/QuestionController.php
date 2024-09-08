<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    function index()
    {
        return view('tops.question');
    }

    function store(Request $request)
    {
        $question = new Question;
        $question -> user_id = Auth::id();
        $question -> job = $request -> job;
        $question -> marital = $request -> marital;
        $question -> children = $request -> children;
        $question -> salary = $request -> salary;
        $question -> business = $request -> business;

        $question -> save();

        return redirect()->route('home');
    }
}
