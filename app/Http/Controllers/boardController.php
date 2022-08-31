<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\board;
use Illuminate\Support\Facades\DB;

class boardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('forum.write');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $user_id = Auth::user()->user_id;
        board::create([
            'user_id' => $request['id'],
            'title' => $request['title'],
            'ctnt' => $request['ctnt'],
        ]);

        // return view('home');
        return redirect()->route('forum');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = DB::table('boards')
                ->where('i_board',$id)
                ->first();

        $comment = DB::table('comments')
                ->where('i_board',$id)
                ->select('comments.i_comment' , 'comments.user_id' , 'comments.i_board' , 'comments.ctnt' , 'comments.created_at')
                ->orderBy('updated_at' , 'desc')
                ->get();

        $count = DB::table('comments')
                ->where('i_board',$id)
                ->count();

        $likeCount = DB::table('likes')
                    ->where('i_board', $id)
                    ->count();

        $likeCheck = DB::table('likes')
                    ->select('likes.i_user')
                    ->where('i_board', $id)
                    ->get();

        $check = 0;

        // $users = DB::table('users')
        //     ->join('contacts', 'users.id', '=', 'contacts.user_id')
        //     ->join('orders', 'users.id', '=', 'orders.user_id')
        //     ->select('users.*', 'contacts.phone', 'orders.price')
        //     ->get();

        return view('forum.view',compact('data' , 'comment' , 'count' ,'likeCount' , 'likeCheck' , 'check'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = DB::table('boards')
                ->where('i_board',$id)
                ->first();

        return view('forum.updboard',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        DB::table('boards')
            ->where('i_board',$id)
            ->update(['title' => strval($request->title) , 'ctnt' => strval($request->ctnt) , 'updated_at' => now()]);

        return response()->json(strval($request->ctnt));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        // 해당 글을 쓴 유저가 아닌 다른 유저가 주소값으로 들어갔을 때 삭제되는 이슈있음
        DB::table('boards')->where('i_board',$id)->delete();

        return redirect()->route('forum');

    }

        public function search(Request $request)
    {

        //
        $data = DB::table('boards')
                ->join('users','user_id','=','users.id')
                ->select('boards.*', 'users.name')
                ->where('title', 'like', '%'.$request->searchText.'%')
                ->orWhere('ctnt', 'like', '%'.$request->searchText.'%')
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
        // $users = DB::table('users')
        //     ->join('contacts', 'users.id', '=', 'contacts.user_id')
        //     ->join('orders', 'users.id', '=', 'orders.user_id')
        //     ->select('users.*', 'contacts.phone', 'orders.price')
        //     ->get();

        return view('forum.index',compact('data' , 'countList' , 'likeCount', 'page'));

    }
}
