<h1 class="display-5">Edit {{ $info->id }}</h1>

@extends('app')

@section('body')

<br>
<div class="d-flex justify-content-center">
    <form action="{{ route('usuario.update', $info) }}" method="POST">
    @csrf
    @method('PUT')
    <fieldset>
        @component('usuario.form', ["info"=>$info, "tipoUsuario"=>$tipoUsuario])
        @endcomponent
    </fieldset>
    </form>
</div>

@endsection