@extends('layouts.forum')

@section('content')

<style>
    a {color: black; text-decoration: none}
</style>
<div class="container">
    <div class="row mt-5">
        <div class="col-12">
            <h4>Movie</h4>
            <ul class="list-group my-4">
                @foreach ($data as $item)
                <li class="list-group-item list-group-item-action">
                    <a href="{{ url('/')}}/view/{{ $item->i_board }}">
                        {{ $item->title }}
                    </a>
                    <span class="badge text-bg-info"><i class="fa-solid fa-comment-dots"></i> 4</span>
                    <span class="badge text-bg-danger">
                    <i class="fa-solid fa-heart"> 3</i>
                    </span>
                    <div>
                      <small>{{ substr($item->updated_at,0,10) }} | by {{ $item->name }}</small>
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="d-grid gap-2 col-6 mx-auto my-3">
            <button class="btn btn-secondary">All Postings of Movie Category</button>
            </div>
        </div>

        <hr>

        <div class="col-12">
            <h4>Music</h4>
            <ul class="list-group my-4">
                <li class="list-group-item list-group-item-action">
                    Three Days of the Condor
                    <span class="badge text-bg-info"><i class="fa-solid fa-comment-dots"></i> 4</span>
                    <span class="badge text-bg-danger">
                    <i class="fa-solid fa-heart"> 3</i>
                    </span>
                    <div>
                      <small>2022-01-22 | by SB Hero</small>
                    </div>
                </li>
                <li class="list-group-item list-group-item-action">
                    Three Days of the Condor
                    <span class="badge text-bg-info"><i class="fa-solid fa-comment-dots"></i> 4</span>
                    <span class="badge text-bg-danger">
                    <i class="fa-solid fa-heart"> 3</i>
                    </span>
                    <div>
                      <small>2022-01-22 | by SB Hero</small>
                    </div>
                </li>
                <li class="list-group-item list-group-item-action">
                    Three Days of the Condor
                    <span class="badge text-bg-info"><i class="fa-solid fa-comment-dots"></i> 4</span>
                    <span class="badge text-bg-danger">
                    <i class="fa-solid fa-heart"> 3</i>
                    </span>
                    <div>
                      <small>2022-01-22 | by SB Hero</small>
                    </div>
                </li>
            </ul>
            <div class="d-grid gap-2 col-6 mx-auto my-3">
            <button class="btn btn-secondary">All Postings of Music Category</button>
            </div>
        </div>
    </div>
</div>
@endsection
