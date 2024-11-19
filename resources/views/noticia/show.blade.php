@include('mensagem')

@extends('app')

@section('body')

<br>
<h1 class="mb-4">{{ $esp->titulo }}</h1>

<div class="card mb-3">
    <div class="card-body">
        <p class="card-text">{{ $esp->conteudo }}</p>
        <small class="text-muted">Publicado em: {{ $esp->created_at->format('d/m/Y H:i') }}</small>
        <br><br>
        <a href="{{ route('noticia.edit', $esp->id) }}" class="btn btn-dark">Alterar</a>
        <form name="{{ 'form_delete_'.$esp->id }}" action="{{ route('noticia.destroy', $esp->id) }}" method="post" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ 'form_delete_'.$esp->id }}')">Deletar</button>
        </form>
        <a href="{{ route('noticia.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
</div>

@endsection
