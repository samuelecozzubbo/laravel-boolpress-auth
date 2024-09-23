@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dahboard</h1>
        <h3>Attualmente sono presenti {{ $count_posts }} post</h3>
    </div>
@endsection
