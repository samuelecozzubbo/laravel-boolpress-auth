@extends('layouts.app')

@section('content')
    <h1>Elenco post </h1>
    @if (@session('cancelled'))
        <div class="alert alert-success" role="alert">
            {{ session('cancelled') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Date</th>
                <th scope="col">Categoria</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->created_at->format('d/m/Y') }}</td>
                    <td>
                        {{-- @dump($post->category)  category è un oggetto --}}
                        {{-- METTO IL NULL SAFE OPERATOR COSI SE CATEGORY E' NULL NON LA STAMPA --}}
                        @if ($post->category)
                            <span class="badge bg-success">
                                <a class="text-white" href="{{ route('admin.postPerCategory', $post->category) }}">
                                    {{ $post->category->name }}
                                </a>

                            </span>
                        @else
                            -
                        @endif

                    </td>
                    <td>
                        <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-info">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        @include('admin.partials.formdelete', [
                            'route' => route('admin.posts.destroy', $post),
                            'message' => "confermi l eliminazione del post $post->title ?",
                        ])
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    {{-- con paginate dentro index viene passato anche il metodo links --}}
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
    {{-- ricordati di importare dentro app server provider paginator e inserisci use bootstrap --}}
@endsection
