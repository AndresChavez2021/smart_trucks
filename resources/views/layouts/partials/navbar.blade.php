<nav class="navbar navbar-expand-md navbar-light text-white shadow-sm" id="headerSidebar">
    <div class="container-fluid">
        @guest
            <a class="navbar-brand text-white" href="/home">Servicio De Internet</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        @else
            <a class="navbar-brand text-white" class="nav-link" href="#" id="sidebarCollapse">
                <i class="fas fa-align-left"></i>
            </a>
        @endguest
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            </ul>
            @auth
                <ul class="navbar-nav me-5 mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('perfil.edit', auth()->user()->id) }}">Configurar
                                    Perfil</a></li>
                            <li><a class="dropdown-item" href="{{ route('password.edit', auth()->user()->id) }}">Cambiar contraseña</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/logout">Logout</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled"></a>
                    </li>
                </ul>
            @endauth
            @guest
                <ul class="navbar-nav me-5 mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="/login">Login</a>
                    </li>
                </ul>
            @endguest
        </div>
    </div>
</nav>
