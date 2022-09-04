@extends('layouts.forum')


@section('content')

<div class="container">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-5">
                <h2>글쓰기</h2>
                <hr>
                <form action="{{ 'store' }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <input class="d-none" type="text" name="id" value="{{ Auth::user()->id }}" readonly>
                        <label for="title" class="form-label">제목</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                    <div>
                        <label for="ctnt" class="form-label">내용</label>
                        <textarea type="text" name="ctnt" id="ctnt" class="form-control"></textarea>
                    </div>

                    <input type="file" name="uploadFile">
       
                    <button class="btn btn-primary mt-3">입력</button>
                </form>

                {{-- <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="submit" value="upload">
                </form> --}}
            </div>
</div>
@endsection