<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ForumController extends Controller
{
        public function index(Request $request)
    {
        isset($request) 
        ?
        $data = DB::table('boards')
                ->join('users','user_id','=','users.id')
                ->select('boards.*', 'users.name')
                ->where('title', 'like', '%'.$request->searchText.'%')
                ->orWhere('ctnt', 'like', '%'.$request->searchText.'%')
                ->orderBy('updated_at' , 'DESC')
                ->paginate(8)
        :
        $data = DB::table('boards')
                ->join('users','user_id','=','users.id')
                ->select('boards.*', 'users.name')
                ->orderBy('updated_at' , 'DESC')
                ->paginate(8);

                
        $page = 1;
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

        return view('forum.index',compact('data' , 'countList' , 'likeCount', 'page'));
    }

}
