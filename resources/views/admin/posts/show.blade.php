@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>{{ $post->title }}</h2>
                <img src=" {{ asset("storage/$post->image") }} " alt="image" width='200' class="img-fluid">
                <p>Contenuto: {{ $post->content }}</p>
                <h4>Categoria: {{ $post->category->name ?? '-' }}</h4>
                <h4>Autore: {{ $post->user->name }}</h4>
                <div>
                    @foreach ($post->tags as $tag)
                        <span class="badge badge-pill badge-{{ $tag->color }}">{{ $tag->name ?? 'Nessun Tag' }}</span>
                    @endforeach
                </div>
            </div>
            <a class="btn btn-warning mr-3" href="{{ route('admin.posts.edit', $post->id) }}">Modifica</a>
            <a class="btn btn-secondary" href="{{ route('admin.posts.index') }}">Indietro</a>
        </div>
    </div>
@endsection
