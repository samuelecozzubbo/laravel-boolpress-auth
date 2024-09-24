@extends('layouts.app')

@section('content')
    @if (@session('cancelled'))
        <div class="alert alert-success" role="alert">
            {{ session('cancelled') }}
        </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <form class="d-flex justify-content-between mt-5" action="{{ route('admin.categories.store') }}"
                    method="POST">
                    @csrf
                    <input name="name" type="text" class="form-control me-3" placeholder="Nuova categoria">
                    <button class="btn btn-success" type="submit">Invia</button>
                </form>
                <table class="table mt-5">
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    <form id="form-edit-{{ $category->id }}"
                                        action="{{ route('admin.categories.update', $category) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input class="input-edit" type="text" name="name"
                                            value="{{ $category->name }}">
                                    </form>
                                    {{-- {{ $category->name }} --}}
                                </td>
                                <td>
                                    <button class="btn btn-warning" type="submit"
                                        onclick="submitEditCategoryForm({{ $category->id }})">Aggiorna</button>
                                </td>
                                <td>
                                    @include('admin.partials.formdelete', [
                                        'route' => route('admin.categories.destroy', $category),
                                        'message' => "confermi l eliminazione della categoria $category->name ?",
                                    ])
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function submitEditCategoryForm(id) {
            const form = document.getElementById(`form-edit-${id}`)
            form.submit();
        }
    </script>
@endsection
