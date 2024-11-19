@include('mensagem')

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

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Tipo Usuário</h1>
        <a href="{{ route('tipoUsuario.create') }}" class="btn btn-success">Novo TipoUsuario</a>
    </div>

    <table class="table table-hover" border="1px">
        <thead>
        <tr>
            <th scope="col">Id</th>  <th scope="col">Nome</th> <th scope="col">Detalhes</th> <th scope="col">Alterar</th> <th scope="col">Excluir</th>
        </tr>
        </thead>
        <?php if ($info != null) { ?>
            @foreach ($info as $item)
            
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->nome}}</td>
                <td>
                    <a href="{{route('tipoUsuario.show', $item->id)}}"><button class="btn btn-dark">Detalhes</button></a>
                </td>
                <td>
                    <a href="{{route('tipoUsuario.edit', $item->id)}}"><button class="btn btn-dark">Alterar</button></a>
                </td>
                <td>
                    <form name="{{'form_delete_'.$item->id}}" action="{{route('tipoUsuario.destroy', $item->id)}}" method="post" name="delete">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" onclick="confirmDelete('{{'form_delete_'.$item->id}}')">Deletar</button>
                    </form>
                </td>
            </tr>
            @endforeach
    @php
        }
    @endphp
    </table>
@endsection