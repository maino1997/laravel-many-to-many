@extends('layouts.app')
@section('content')
    <div class="container">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Colore</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <th scope="row">{{ $tag->id }}</th>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->color }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
