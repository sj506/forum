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
        board::create([
            'user_id' => $request['id'],
            'title' => $request['title'],
            'ctnt' => $request['ctnt'],
        ]);

        $data = DB::table('boards')->get();;

        // return view('home');
        return view('forum.index',compact('data'));
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
        return view('forum.view',compact('data'));
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

        $data = DB::table('boards')
                ->join('users','user_id','=','users.id')
                ->select('boards.*', 'users.name')
                ->get();

        return view('forum.index',compact('data'));
    }
}
