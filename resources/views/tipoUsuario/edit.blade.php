<h1 class="display-5">Edit {{ $info->id }}</h1>

@extends('app')

@section('body')

<br>
<div class="d-flex justify-content-center">
    <form action="{{ route('tipoUsuario.update', $info) }}" method="POST">
    @csrf
    @method('PUT')
    <fieldset>
        @component('tipoUsuario.form', ["info"=>$info])
        @endcomponent
    </fieldset>
    </form>
</div>

@endsection