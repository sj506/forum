@extends('layouts.forum')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 border mt-5">
            <h3>{{ $data->title }}</h3>
            <p>
                {{ $data->ctnt }}
            </p>
            <hr>
            <div class="d-grid d-md-flex justify-content-md-end mb-3">
                <button class="btn btn-primary me-md-2" type="button">Edit</button>
                <button class="btn btn-danger" type="button">Danger</button>
            </div>
        </div>
        <div>
            <div class="col-12">
                <div class="d-grid gap-2 col-3 mx-auto">
                        <button class="btn btn-outline-danger fs-6 mt-3">
                            <i class="fa-solid fa-heart"> 3</i>
                        </button>
                </div>
            </div>
            <div class="col-12">
                <ul class="list-group mt-3">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                    <li class="list-group-item">A fourth item</li>
                    <li class="list-group-item">And a fifth one</li>
                </ul>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" class="form-control mt-1" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                    <button class="btn btn-primary me-md-2 h-50" type="button">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection