<div class="form-group">
    <label for="titulo">Título:</label>
    <input type="text" name="titulo" id="titulo" class="form-control" required
    value="@if(isset($info->titulo)){{ $info->titulo }}@endif">
</div>

<div class="form-group">
    <label for="conteudo">Conteúdo:</label>
    <textarea name="conteudo" id="conteudo" class="form-control" rows="5" required>@if(isset($info->conteudo)){{ $info->conteudo }}@endif</textarea>
</div>

<div class="form-group">
    <label for="usuario_id">Usuário:</label>
    <select name="usuario_id" id="usuario_id" class="form-control" required>
        @foreach ($user as $usuario)
        <option value="{{ $usuario->id }}" 
            @if(isset($info->usuario_id) && $info->usuario_id == $usuario->id) selected @endif>
            {{ $usuario->name }}
        </option>
        @endforeach
    </select>
</div>

<br>
<div class="d-flex justify-content-center">
    <button type="submit" class="btn btn-dark" name="envia">Enviar</button>
</div>