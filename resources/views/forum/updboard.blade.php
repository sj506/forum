@extends('layouts.forum')


@section('content')

@include('ins.loginCheck')

<div class="container">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-5">
                <h2>글수정</h2>
                <hr>
                <form action="{{ url('/')}}/update/{{ $data->i_board }}" method="post">
                    @csrf
                    <div>
                        <input class="d-none" type="text" name="id" value="{{ Auth::user()->id }}" readonly>
                        <label for="title" class="form-label">제목</label>
                        <input type="text" name="title" id="title" value="{{ $data->title }}" class="form-control">
                    </div>
                    <div>
                        <label for="ctnt" class="form-label">내용</label>
                        <textarea type="text" name="ctnt" id="ctnt" class="form-control">{{ $data->ctnt }}</textarea>
                    </div>
                    <button class="btn btn-primary mt-3">입력</button>
                </form>
            </div>
</div>
@endsection