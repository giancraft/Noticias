<div class="form-group">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" class="form-control" required
    value="@if(isset($info->nome)){{ $info->nome }}@endif">
</div>

<br>
<div class="d-flex justify-content-center">
    <button type="submit" class="btn btn-dark" name="envia">Enviar</button>
</div>