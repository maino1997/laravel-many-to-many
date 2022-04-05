@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    @if ($post->exists)
        <form action='{{ route('admin.posts.update', $post->id) }}' method='POST' enctype="multipart/form-data">
            @method('PUT')
        @else
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
    @endif
    @csrf

    <div class="form-group">
        <label for="exampleInputEmail1">Titolo</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1"
            aria-describedby="emailHelp" name="title" value="{{ old('title', $post->title) }}">
        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">URL dell'immagine</label>
        <input type="file" class="form-control-file  @error('image') is-invalid @enderror" id="image-input" name="image">
        @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-check-label" for="exampleCheck1">Contenuto</label>
        <input type="text" class="form-control  @error('content') is-invalid @enderror" id="exampleCheck1"
            name="content" value="{{ old('content', $post->content) }}">
        @error('content')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <select name="category_id" id="category">
            <option value="">Nessuna Categoria</option>
            @foreach ($categories as $category)
                <option @if (old('category_id', $post->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                    {{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" id="ispub" name="is_published"
            @if (old('is_published', $post->is_published)) checked @endif>
        <label class="form-check-label" for="ispub">
            Pubblicato
        </label>
        <div>
        </div>
    </div>
    <div class="form-group">
        <img src="{{ $comic->thumb ?? 'http://www.asdalcione.it/wp-content/uploads/2016/08/jk-placeholder-image-1.jpg' }}"
            alt="placeholder" id="image-src" width="200" class="img-fluid">
    </div>
    <div class="row">
        @foreach ($tags as $tag)
            <div class="col-2 @error('tags') is-invalid @enderror">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $tag->id }}"
                        id="tag-{{ $tag->id }}" name="tags[]" @if (in_array($tag->id, old('tags', $post_tags_ids ?? []))) checked @endif>
                    <label class="form-check-label" for="tag-{{ $tag->id }}">
                        {{ $tag->name }}
                    </label>
                    <div>
                    </div>
                </div>
            </div>
        @endforeach
        @error('tags')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Crea</button>
    </form>

</div>

<script src="{{ asset('js/image-preview.js') }}" defer>
</script>
