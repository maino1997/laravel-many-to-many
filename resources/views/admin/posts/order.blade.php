@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h2 class="m-5">Post per Categoria</h2>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-3">
                    <h3>{{ $category->name }}</h3>
                    @foreach ($category->posts as $post)
                        <h5>{{ $post->title }}</h5>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
