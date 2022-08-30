@extends('layouts.forum')

@section('content')

<style>
    a {color: black; text-decoration: none}
</style>
<div class="container">
    <div class="row mt-5">
        <div class="col-12">
            <h4>My board</h4>
            <ul class="list-group my-4">
                @foreach ($data as $item)
                <li class="list-group-item list-group-item-action">
                    <a href="{{ url('/')}}/view/{{ $item->i_board }}">
                        {{ $item->title }}
                    </a>
                    @foreach ($countList as $count)
                        @if ($item->i_board === $count['i_board'])
                            <span class="badge text-bg-info ms-2"><i class="fa-solid fa-comment-dots"></i> {{ $count['count'] }}</span>
                        @endif
                    @endforeach
                    @foreach ($likeCount as $count)
                        @if ($item->i_board === $count['i_board'])
                        <span class="badge text-bg-danger">
                            <i class="fa-solid fa-heart"> {{ $count['count'] }}</i>
                        </span>
                        @endif
                    @endforeach
                    <div>
                      <small>{{ substr($item->updated_at,0,10) }} | by {{ $item->name }}</small>
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="d-flex justify-content-center my-3">
                @if ($data->currentPage() !== 1)
                    <button class="btn btn-secondary" onclick="location.href='{{ url('/')}}?page={{ $data->currentPage() -1 }}'">이전 글</button>
                @endif
                @if ($data->currentPage() !== $data->lastPage())
                    <button class="btn btn-secondary ms-3" onclick="location.href='{{ url('/')}}?page={{ $data->currentPage() +1 }}'">다음 글</button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
