<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        .header-container {
            position: absolute;
            top: 0;
            right: 0;
            margin: 1rem;
        }
        .user-info {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .user-info img {
            width: 40px;
            height: 40px;
            margin-bottom: 0.5rem;
        }
        .nav-tabs {
            margin-top: 3rem;
        }
    </style>
</head>
<body>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('noticia.index') ? 'active' : '' }}" aria-current="page" href="{{ route('noticia.index') }}">Noticia</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('usuario.index') ? 'active' : '' }}" href="{{ route('usuario.index') }}">Usuario</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('tipoUsuario.index') ? 'active' : '' }}" href="{{ route('tipoUsuario.index') }}">TipoUsuario</a>
        </li>
    </ul>
</body>
</html>
