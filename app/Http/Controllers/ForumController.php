<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ForumController extends Controller
{
        public function index()
    {
        $page = 1;
        $data = DB::table('boards')
                ->join('users','user_id','=','users.id')
                ->select('boards.*', 'users.name')
                ->orderBy('updated_at' , 'DESC')
                ->paginate(8);

        $countList = [];
        foreach ($data as $key => $item) {
                    $count = DB::table('comments')
                    ->where('i_board',$item->i_board)
                    ->count('i_comment');
            array_push($countList , ['count'=> $count , 'i_board' => $item->i_board]);
        }

        $likeCount = [];
        foreach ($data as $key => $item) {
                    $count = DB::table('likes')
                    ->where('i_board',$item->i_board)
                    ->count();
            array_push($likeCount , ['count'=> $count , 'i_board' => $item->i_board]);
        }

        // $users = DB::table('users')
        //     ->join('contacts', 'users.id', '=', 'contacts.user_id')
        //     ->join('orders', 'users.id', '=', 'orders.user_id')
        //     ->select('users.*', 'contacts.phone', 'orders.price')
        //     ->get();
        return view('forum.index',compact('data' , 'countList' , 'likeCount', 'page'));
    }

}
