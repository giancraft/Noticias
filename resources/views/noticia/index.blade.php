@include('mensagem')

<br>
<h1 class="mb-0">Notícias</h1>

@extends('app')

<script>
    function confirmDelete(formName) {
        if (confirm('Tem certeza que deseja excluir este item?')) {
            document.forms[formName].submit();
        }
    }
</script>

@section('body')

<br>

@auth

<div class="d-flex justify-content-end align-items-center mb-4 px-4">
    <a href="{{ route('noticia.create') }}" class="btn btn-success">Nova Notícia</a>
</div>
@endauth

@foreach($info as $noticia)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $noticia->titulo }}</h5>
            <p class="card-text">{{ Str::limit($noticia->conteudo, 100) }}</p>
            <div class="d-flex justify-content-start align-items-center gap-2">
                <a href="{{ route('noticia.show', $noticia->id) }}" class="btn btn-primary">Leia mais</a>
                
                {{-- Exibe os botões de Alterar e Deletar apenas para usuários autenticados --}}
                @auth
                    <a href="{{ route('noticia.edit', $noticia->id) }}" class="btn btn-warning">Alterar</a>
                    <form name="{{ 'form_delete_'.$noticia->id }}" action="{{ route('noticia.destroy', $noticia->id) }}" method="post" class="mb-0">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ 'form_delete_'.$noticia->id }}')">Deletar</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
@endforeach

@endsection
