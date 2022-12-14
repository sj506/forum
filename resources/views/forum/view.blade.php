@extends('layouts.forum')
    <meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 border mt-5">
            <div class="mt-4 ms-4">
            <h3>{{ $data->title }}</h3>
            <p>
                {{ $data->ctnt }}
            </p>
            <hr>
            </div>
            <div class="d-grid d-md-flex justify-content-md-end mb-3">
                @auth
                @if ($data->user_id === Auth::user()->id)                    
                <button class="btn btn-primary me-md-2" type="button"><a class="text-light" href="{{ url('/')}}/updboard/{{ $data->i_board }}">Edit</a></button>
                <button class="btn btn-danger" type="button"><a class="text-light" href="{{ url('/')}}/delboard/{{ $data->i_board }}">Delete</a></button>
                @endif
                @endauth
            </div>
        </div>
        <div>
            <div class="col-12">
                <div class="d-grid gap-2 col-3 mx-auto">
                    @auth
                        <button class="btn fs-6 mt-3 likeButton {{ $likeCheck ? 'btn-danger' : 'btn-outline-danger' }}" value="{{ $likeCheck }}" onclick="heartClick(event , {{ $data->i_board }} , {{ Auth::user()->id }} , {{ $likeCheck }})">
                            <i class="fa-solid fa-heart">
                                <span class="like-count me-1">{{ $likeCount }}</span></i>
                        </button>
                    @endauth
                    @if (!Auth::user())
                        <button class="btn btn-outline-danger fs-6 mt-3" onclick="alert('로그인 후에 가능합니다.')">
                            <i class="fa-solid fa-heart"> {{ $likeCount }}</i>
                        </button>
                    @endif 
                </div>
            </div>
            <div class="col-12">
                <ul class="list-group mt-3">
                    @foreach ($comment as $item)
                    {{-- @if (!$item->ctnt)
                        <li class="list-group-item">첫번째 댓글을 남겨주세요.</li>
                    @endif --}}
                    <div class="d-flex w-100 position-relative">
                        <li class="list-group-item w-100">{{ $item->ctnt }}
                        </li>
                        @if ($item->user_id === Auth::user()->id)
                            <a href="{{ url('/')}}/delcomment/{{ $item->i_comment }}/{{ $data->i_board }}"><i class="fa-solid fa-xmark position-absolute translate-middle" style="top: 52%; left: 97%"></i></a>
                        @endif
                    </div>
                    @endforeach
                </ul>
                <div class="col-12 mt-2">
                    <form class="d-flex" action="{{ url('/')}}/inscomment/{{ $data->i_board }}" method="post">
                        @csrf
                        <div class="input-group input-group-sm mb-3">
                            @auth
                                <input class="d-none" type="text" name="id" value="{{ Auth::user()->id }}" readonly>
                            @endauth
                            <input name="ctnt" type="text" class="form-control mt-1" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        </div>
                        <button class="btn btn-primary ms-md-2 h-50">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>

        function heartClick(event, iBaord, iUser, likeCheck) {
            console.log(event.target.value); 
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('insheart') }}",
                method: 'POST',
                dataType: 'json',
                data: {
                    'i_board' : iBaord,
                    'i_user' : iUser,
                    'like_check' : event.target.value
                },
                success: function(result) {
                    console.log(result)
                    if(event.target.value == 0) {
                    $('.likeButton').removeClass('btn-outline-danger')
                    $('.likeButton').addClass('btn-danger')
                    $('.like-count').html(parseInt($('.like-count').text()) + 1)
                    event.target.value = 1;
                    } else {
                    $('.likeButton').removeClass('btn-danger')
                    $('.likeButton').addClass('btn-outline-danger')
                    $('.like-count').html(parseInt($('.like-count').text()) - 1) 
                    event.target.value = 0;
                    }
                },
                error:function(request,status,error){
                    alert('좋아요에 실패하였습니다.')
                    console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            });
        } 

//         (function(){
//   // 실행할 기능을 정의해주세요.
//             if($('.likeButton').value == 0) {
//                 $('.likeButton').removeClass('btn-outline-danger')
//                 $('.likeButton').addClass('btn-danger')
//                 $('.like-count').html(parseInt($('.like-count').text()) + 1)
//                 event.target.value = 1;
//             } else {
//                 $('.likeButton').removeClass('btn-danger')
//                 $('.likeButton').addClass('btn-outline-danger')
//                 $('.like-count').html(parseInt($('.like-count').text()) - 1) 
//                 event.target.value = 0;
//             }
// })();
</script>