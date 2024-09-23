@extends('layouts.app')

@section('content')
    <h1>{{ $post->title }}</h1>

    <p>{{ $post->txt }}</p>

    <p><strong>Tempo di lettura:</strong> {{ $post->reading_time }} minuti</p>

    <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Torna alla lista dei post</a>
@endsection
