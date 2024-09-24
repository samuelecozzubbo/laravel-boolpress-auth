@extends('layouts.app')

@section('content')
    <h1>Elenco post per la categoria: {{ $category->name }}</h1>
    <ul class="list-group">
        {{-- Dentro li devo fare un altro ciclo per prendere tutti i post con quella categoria --}}
        {{-- @dump($category->posts) --}}
        @foreach ($category->posts as $post)
            <li class="list-group-item d-flex justify-content-between">
                <span>{{ $post->title }}</span>
                <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-warning">Vedi</a>
            </li>
        @endforeach

    </ul>
@endsection
