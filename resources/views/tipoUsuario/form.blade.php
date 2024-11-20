<div class="form-group">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" class="form-control" required
    value="@if(isset($info->nome)){{ $info->nome }}@endif">
</div>
<div class="d-flex justify-content-center mt-3 gap-3">
    <a href="{{ route('tipoUsuario.index') }}" class="btn btn-secondary">Voltar</a>
    <button type="submit" class="btn btn-dark" name="envia">Enviar</button>
</div>
