@extends('layouts.app')

@section('content')
    <h1>Elenco post eliminati</h1>
    @if (@session('cancelled'))
        <div class="alert alert-success" role="alert">
            {{ session('cancelled') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Date</th>
                <th scope="col">Categoria</th>
                <th scope="col">Tag</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td class="col-2">
                        <img class="w-100" src="{{ asset('storage/' . $post->path_image) }}"
                            alt="{{ $post->image_original_name }}" onerror="this.src='{{ asset('img/no-image.png') }}'">
                        <p>{{ $post->image_original_name }}</p>
                    </td>
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

                        {{-- @dump($post->tags) --}}
                        @forelse ($post->tags as $tag)
                            <span class="badge bg-warning">
                                {{ $tag->name }}
                            </span>
                        @empty
                            -
                        @endforelse
                    </td>
                    <td>
                        <form class="d-inline" action="{{ route('admin.posts.restore', $post->id) }}" method="POST"
                            onsubmit="return confirm('Vuoi ripristinare?')">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success" type="submit">Ripristina</button>
                        </form>
                        <form class="d-inline" action="{{ route('admin.posts.delete', $post->id) }}" method="POST"
                            onsubmit="return confirm('Vuoi eliminare definitivamente?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Elimina definitivamente</button>
                        </form>
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
