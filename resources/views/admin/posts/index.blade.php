@extends('layouts.app')

@section('content')
    @include('includes.alert')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <header>
                    <h1>I miei post:</h1>
                </header>
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">Crea un Post</a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titolo</th>
                            <th scope="col">Contenuto</th>
                            <th scope="col">Immagine</th>
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                            <tr>
                                <th scope="row">{{ $post->id }}</th>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->content }}</td>
                                <td><img src="{{ $post->image }}" alt="{{ $post->image }}"></td>
                                <td>
                                    @if ($post->category)
                                        <span
                                            class="badge badge-pill badge-{{ $post->category->color }}">{{ $post->category->name }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if ($post->user)
                                        {{ $post->user->name }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td><a class="btn btn-primary"
                                        href="{{ route('admin.posts.show', $post->id) }}">Dettaglio</a></td>
                                <td><a class="btn btn-warning"
                                        href="{{ route('admin.posts.edit', $post->id) }}">Modifica</a></td>
                                <td>
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                                        class="delete-form">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Elmina</button>
                                    </form>
                                </td>
                                <td class="d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-pen-to-square mr-3"></i>
                                    <i class="fa-solid fa-trash"></i>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <h3>Non ci sono post</h3>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('admin.posts.order') }}">Visualizza i post per Categoria</a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src=" {{ asset('js\confirmation-delete.js') }}" defer></script>
    <script src=" {{ asset('js\image-preview.js') }}" defer></script>
@endsection
