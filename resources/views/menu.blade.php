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

        /* Garantir que os botões fiquem lado a lado */
        .auth-buttons {
            display: flex;
            gap: 10px; /* Espaço entre os botões */
            justify-content: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-container">
            <!-- Exibe as informações do usuário logado -->
            @auth
                <div class="user-info">
                    <a href="{{ route('usuario.show', Auth::user()->id) }}">
                        <img src="https://w7.pngwing.com/pngs/343/677/png-transparent-computer-icons-user-profile-login-my-account-icon-heroes-black-user-thumbnail.png" class="rounded-circle" alt="User Image">
                    </a>
                    <span class="mx-2">{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                    </form>
                </div>
            @endauth

            <!-- Exibe os botões de login e registro para usuários não autenticados -->
            @guest
                <div class="auth-buttons">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-success btn-sm">Registrar</a>
                </div>
            @endguest
        </div>
    </div>

    <ul class="nav nav-tabs">
        <!-- Rota Pública (Apenas para index e show de notícias) -->
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('noticia.index') ? 'active' : '' }}" aria-current="page" href="{{ route('noticia.index') }}">Noticia</a>
        </li>

        <!-- Apenas visível para administradores -->
        @auth
            @if (Auth::user()->tipo_usuario_id == 1) <!-- Assumindo que 1 é o ID do Administrador -->
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('usuario.index') ? 'active' : '' }}" href="{{ route('usuario.index') }}">Usuario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('tipoUsuario.index') ? 'active' : '' }}" href="{{ route('tipoUsuario.index') }}">TipoUsuario</a>
                </li>
            @endif
        @endauth

        <!-- Apenas visível para clientes -->
        @auth
            @if (Auth::user()->tipo_usuario_id == 5) <!-- Assumindo que 5 é o ID do Cliente -->
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('noticia.create') ? 'active' : '' }}" href="{{ route('noticia.create') }}">Criar Notícia</a>
                </li>
            @endif
        @endauth
    </ul>
</body>
</html>
