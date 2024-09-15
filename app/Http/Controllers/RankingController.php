<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function post(){
        return view ('rankings.post');
    }

    public function user(){
        return view ('rankings.user');
    }
}
