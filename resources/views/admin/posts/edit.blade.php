@extends('layouts.app')

@section('content')
    <h1>Modifica</h1>
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.posts.update', $post) }}" method="POST">
        @method('PUT')
        @csrf <!-- Token CSRF necessario per protezione -->

        <!-- Campo per il titolo -->
        <div class="form-group">
            <label for="title">Titolo</label>
            <input value="{{ old('title', $post->title) }}" type="text" name="title" id="title"
                class="@error('title') is-invalid @enderror form-control">
            @error('title')
                <small class="text-danger"> {{ $message }} </small>
            @enderror
        </div>

        <!-- Campo per il testo del post -->
        <div class="form-group">
            <label for="txt">Testo</label>
            <textarea name="txt" id="txt" class="@error('txt') is-invalid @enderror form-control" rows="5">{{ old('txt', $post->txt) }}</textarea>
            @error('txt')
                <small class="text-danger"> {{ $message }} </small>
            @enderror
        </div>

        <!-- Campo per il tempo di lettura -->
        <div class="form-group">
            <label for="reading_time">Tempo di lettura (in minuti)</label>
            <input value="{{ old('reading_time', $post->reading_time) }}" type="number" name="reading_time"
                id="reading_time" class="@error('reading_time') is-invalid @enderror form-control" min="1">
            @error('reading_time')
                <small class="text-danger"> {{ $message }} </small>
            @enderror
        </div>

        <!-- Bottone per inviare il form -->
        <button type="submit" class="btn btn-primary">Modifica Post</button>
    </form>
@endsection
