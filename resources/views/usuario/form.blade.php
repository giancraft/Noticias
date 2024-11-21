<div class="form-group">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" class="form-control" required
    value="@if(isset($info->name)){{ $info->name }}@endif">
</div>

<div class="form-group">
    <label for="email">Email:</label>
    <input type="text" name="email" id="email" class="form-control" required
    value="@if(isset($info->email)){{ $info->email }}@endif">
</div>

<div class="form-group">
    <label for="senha">Senha:</label>
    <input type="password" name="senha" id="senha" class="form-control" required
    value="@if(isset($info->password)){{ $info->password }}@endif">
</div>

<div class="form-group">
    <label for="tipo_usuario_id">Tipo Usuário:</label>
    <select name="tipo_usuario_id" id="tipo_usuario_id" class="form-control" required>
        @foreach ($tipoUsuario as $tipo)
        <option value="{{ $tipo->id }}" 
            @if(isset($info->tipo_usuario_id) && $info->tipo_usuario_id == $tipo->id) selected @endif>
            {{ $tipo->nome }}
        </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="empresa_id">Empresa:</label>
    <select name="empresa_id" id="empresa_id" class="form-control" required>
        @foreach ($empresa as $emp)
        <option value="{{ $emp->id }}" 
            @if(isset($info->empresa_id) && $info->empresa_id == $emp->id) selected @endif>
            {{ $emp->nome }}
        </option>
        @endforeach
    </select>
</div>

<div class="d-flex justify-content-center mt-3 gap-3">
    <a href="{{ route('usuario.index') }}" class="btn btn-secondary">Voltar</a>
    <button type="submit" class="btn btn-dark" name="envia">Enviar</button>
</div>
