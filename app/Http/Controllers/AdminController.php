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

    public function reports(Request $request)
    {
        $query = $request -> input('query');
        $date = $request -> input('date');
        $sortBy = $request -> input('sort_by', 'created_at'); //デフォルト
        $order = $request -> input('order', 'desc'); //デフォルト

        $reports = Report::with('user', 'post')
            ->when($query, function ($queryBuilder) use ($query){
                return $queryBuilder->WhereHas('post.user', function($q) use ($query){
                    $q->where('name', 'LIKE', "%{$query}%");
                })->orWhere('reason', 'LIKE', "%{$query}%");
            })
            ->when($date, function($queryBuilder) use ($date){
                return $queryBuilder->WhereDate('created_at', $date);
            })
            ->orderBy($sortBy, $order)->get();
            // ->paginate(10);

        if($request->ajax()){
            return view('admin.reports_partial', compact('reports'));
        }

        return view('admin.reports', compact('reports'));
    }



    public function exchange(Request $request)
    {
        $query= $request -> input('query');
        $date= $request ->input('date');
        $sortBy = $request -> input('sort_by', 'created_at'); //デフォルト
        $order = $request -> input('order', 'desc'); //デフォルト

        $gifts = Amazon::with('user')
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('number', 'LIKE', "%{$query}%")
                        ->orWhere('money', 'LIKE', "%{$query}%")
                        ->orWhere('created_at', 'LIKE', "%{$query}%")
                        ->orWhereHas('user', function($qUser) use ($query) {
                            $qUser->where('name', 'LIKE', "%{$query}%")
                                    ->orWhere('email', 'LIKE', "%{$query}%");
                        });
                })
                ->when($date, function ($queryBuilder) use ($date) {
                    return $queryBuilder->whereDate('created_at', $date);
                })
                ->orderBy($sortBy, $order)->get();
                // ->paginate(10);
        
        if($request->ajax()){
            return view('admin.exchange_partial', compact('gifts'));
        }

        return view('admin.exchange', compact('gifts'));
    }


    public function inbox(Request $request)
    {
        $query = $request -> input('query');
        $date = $request -> input('date');
        $status = $request -> input('status');
        $sortBy = $request -> input('sort_by', 'created_at'); //デフォルト
        $order = $request -> input('order', 'desc'); //デフォルト
        
        $contacts = Contact::with('user')
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('category', 'LIKE', "%{$query}%")
                    ->orWhere('title', 'LIKE', "%{$query}%")
                    ->orWhere('created_at', 'LIKE', "%{$query}%")
                    ->orWhere('updated_at', 'LIKE', "%{$query}%")
                    ->orWhereHas('user', function($qUser) use ($query) {
                        $qUser->where('name', 'LIKE', "%{$query}%")
                                ->orWhere('email', 'LIKE', "%{$query}%");
                    });
            })
            ->when($date, function ($queryBuilder) use ($date) {
                return $queryBuilder->whereDate('created_at', $date);
            })
            ->orderBy($sortBy, $order)
        ->paginate(9);

        if($request->ajax()){
            return view('admin.inbox_partial', compact('contacts'));
        }

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
