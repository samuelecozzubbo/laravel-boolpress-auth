@extends('layouts.app')

@section('content')
    <h1>Crea un nuovo post</h1>
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.posts.store') }}" method="POST">
        @csrf <!-- Token CSRF necessario per protezione -->

        <!-- Campo per il titolo -->
        <div class="form-group mb-3">
            <label for="title">Titolo</label>
            <input value="{{ old('title') }}" type="text" name="title" id="title"
                class="@error('title') is-invalid @enderror form-control">
            @error('title')
                <small class="text-danger"> {{ $message }} </small>
            @enderror
        </div>

        <!-- Campo per il testo del post -->
        <div class="form-group mb-3">
            <label for="txt">Testo</label>
            <textarea name="txt" id="txt" class="@error('txt') is-invalid @enderror form-control" rows="5">{{ old('txt') }}</textarea>
            @error('txt')
                <small class="text-danger"> {{ $message }} </small>
            @enderror
        </div>

        <!-- Campo per il tempo di lettura -->
        <div class="form-group mb-3">
            <label for="reading_time">Tempo di lettura (in minuti)</label>
            <input value="{{ old('reading_time') }}" type="number" name="reading_time" id="reading_time"
                class="@error('reading_time') is-invalid @enderror form-control" min="1">
            @error('reading_time')
                <small class="text-danger"> {{ $message }} </small>
            @enderror
        </div>

        {{-- Campo categoria --}}
        <div class="form-group mb-3">
            <label for="category">Categoria</label>
            <select class="form-select" aria-label="Default select example" id="category" name="category_id">
                <option value="">Seleziona una categoria</option>
                @foreach ($categories as $category)
                    <option @if (old('category_id') == $category->id) selected @endif value="{{ $category->id }}">
                        {{ $category->name }}</option>
                @endforeach

            </select>
        </div>

        {{-- Tag --}}
        <div class="form-group mb-3">
            <label for="category">Tags</label>
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                @foreach ($tags as $tag)
                    <input type="checkbox" class="btn-check" id="tag-{{ $tag->id }}" autocomplete="off"
                        value="{{ $tag->id }}" name="tags[]" @if (in_array($tag->id, old('tags', []))) checked @endif>
                    <label class="btn btn-outline-primary" for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                @endforeach
                {{-- Dentro all if in array controlla se tag id è presente nell array old che però all inizio è vuoto quindi darebbe errore
                dunque passo come parametro un array vuoto --}}
            </div>
        </div>

        <!-- Bottone per inviare il form -->
        <button type="submit" class="btn btn-primary">Crea Post</button>
    </form>
@endsection
