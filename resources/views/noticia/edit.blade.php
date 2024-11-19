<h1 class="display-5">Edit {{ $info->id }}</h1>

@extends('app')

@section('body')

<br>
<div class="d-flex justify-content-center">
    <form action="{{ route('noticia.update', $info) }}" method="POST">
    @csrf
    @method('PUT')
    <fieldset>
        @component('noticia.form', ["info"=>$info, "user"=>$user])
        @endcomponent
    </fieldset>
    </form>
</div>

@endsection