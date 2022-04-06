@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h2>Nome del Tag: {{ $tag->name }}</h2>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Autore</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tag->posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->user->name }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
