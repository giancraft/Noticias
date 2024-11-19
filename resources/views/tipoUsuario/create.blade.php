<h1 class="display-5">Create</h1>

@extends('app')

@section('body')

<br>
<div class="d-flex justify-content-center">
    <form action="{{ route('tipoUsuario.store') }}" method="POST">
    @csrf
    <fieldset>
        @component('tipoUsuario.form')
        @endcomponent
    </fieldset>
    </form>
</div>

@endsection