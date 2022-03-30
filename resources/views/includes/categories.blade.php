@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container text-center">
    @if ($category->exists)
        <form action='{{ route('admin.categories.update', $category->id) }}' method='POST'>
            @method('PUT')
            <h2>Modifica la Categoria</h2>
        @else
            <form action="{{ route('admin.categories.store') }}" method="POST">
                <h2>Crea una nuova Categoria</h2>
    @endif
    @csrf


    <div class="form-group">
        <label for="category_name">Inserire il nome della categoria</label>
        <input type="text" name="name" id="category_name" value="{{ old('name', $category->name) }}">
    </div>

    <div class="form-group">
        <label for="category_color">Inserire il colore della categoria</label>
        <input type="text" name="color" id="category_color" value="{{ old('color', $category->color) }}">
    </div>

    <button type=" submit" class="btn btn-primary mr-3">Crea</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary mr-3">Indietro</a>
    </form>

</div>

<script src="{{ asset('js/image-preview.js') }}" defer>
</script>
