@extends('layouts.app')

@section('content')
    @include('includes.alert')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <header>
                    <h1>Le mie categorie:</h1>
                </header>
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="{{ route('admin.categories.create') }}">Crea una nuova categoria</a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Colore</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <th scope="row">{{ $category->id }}</th>
                                <td>{{ $category->name }}</td>
                                <td><span
                                        class="badge badge-pill badge-{{ $category->color }}">{{ $category->name }}</span>
                                </td>


                                <td><a class="btn btn-primary"
                                        href="{{ route('admin.categories.show', $category->id) }}">Dettaglio</a></td>
                                <td><a class="btn btn-warning"
                                        href="{{ route('admin.categories.edit', $category->id) }}">Modifica</a></td>
                                <td>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
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
