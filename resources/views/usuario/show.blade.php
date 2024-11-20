@extends('app')

@section('body')
    <br><br>

    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header d-flex justify-content-between align-items-center p-2">
            <h5 class="mb-0">Detalhes do Tipo Usuário: {{ $esp->nome }}</h5>
        </div>
        <div class="card-body p-3">
            <dl class="row mb-0">
                <dt class="col-sm-4">ID:</dt>
                <dd class="col-sm-8">{{ $esp->id }}</dd>

                <dt class="col-sm-4">Nome:</dt>
                <dd class="col-sm-8">{{ $esp->name }}</dd>

                <dt class="col-sm-4">Email:</dt>
                <dd class="col-sm-8">{{ $esp->email }}</dd>

            </dl>

            <div class="d-flex justify-content-start mt-3 gap-2">
                <a href="{{ route('usuario.index') }}" class="btn btn-secondary btn-sm">Voltar</a>
                <a href="{{ route('usuario.edit', $esp->id) }}" class="btn btn-warning btn-sm">Alterar</a>
                <form name="form_delete" action="{{ route('usuario.destroy', $esp->id) }}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir este tipo de usuário?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                </form>
            </div>
        </div>
    </div>

@endsection
