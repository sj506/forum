<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ForumController extends Controller
{
        public function index()
    {
        $data = DB::table('boards')
                ->join('users','user_id','=','users.id')
                ->select('boards.*', 'users.name')
                ->get();

        // $users = DB::table('users')
        //     ->join('contacts', 'users.id', '=', 'contacts.user_id')
        //     ->join('orders', 'users.id', '=', 'orders.user_id')
        //     ->select('users.*', 'contacts.phone', 'orders.price')
        //     ->get();
        return view('forum.index',compact('data'));
    }

}
