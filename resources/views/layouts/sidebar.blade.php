    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" class="active">
            <div class="sidebar-header">
                <center>
                    <h3>
                        <img class="brand-logo-dark" src="{{ url('assets/icon.png') }}" width="100" />
                    </h3>
                </center>
                <strong>
                    <img class="brand-logo-dark" src="{{ url('assets/icon.png') }}" alt="" width="40px" />
                </strong>
            </div>
            <ul class="list-unstyled components">
                <li class="{{ 'home' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('/home') }}">
                        <i class="fas fa-home"></i>
                        <b>Home</b>
                    </a>
                </li>
                <li
                    class="{{ 'empleados' == Request::is('empleados*') ? 'active' : '' }} or {{ 'clientes' == Request::is('clientes*') ? 'active' : '' }}
                or {{ 'users' == Request::is('users*') ? 'active' : '' }} or {{ 'roles' == Request::is('roles*') ? 'active' : '' }}
                or {{ 'equiposRecorridos' == Request::is('equiposRecorridos*') ? 'active' : '' }}">
                    <a href="#UserMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-users"></i>
                        <b>Gestión De Usuarios</b>
                    </a>
                    <ul class="collapse list-unstyled" id="UserMenu">
                        <li class="{{ 'empleados' == Request::is('empleados*') ? 'active' : '' }}">
                            <a href="{{ url('/empleados') }}"><i class="fa fa-user-tie"></i> <b>Empleados</b></a>
                        </li>
                        <!--
                        <li class="{{ 'clientes' == Request::is('clientes*') ? 'active' : '' }}">
                            <a href="{{ url('/clientes') }}"><i class="fa fa-user"></i> <b>Clientes</b></a>
                        </li>
                        <li class="{{ 'users' == Request::is('users*') ? 'active' : '' }}">
                            <a href="{{ url('/users') }}"><i class="fa fa-users"></i> <b>Usuarios</b></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-clipboard"></i> <b>Bitácora</b></a>
                        </li>
                    -->
                        <li class="{{ 'roles' == Request::is('roles*') ? 'active' : '' }}">
                            <a href={{ url('/roles') }}><i class="fa fa-user-lock"></i> <b>Privilegios</b></a>
                        </li>
                        <li class="{{ 'equiposRecorridos' == Request::is('equiposRecorridos*') ? 'active' : '' }}">
                            <a href="{{ url('/equiposRecorridos') }}">
                                <i class="fas fa-user-plus"></i>
                                <b> Equipos Recorridos</b>
                            </a>
                        </li>
                        <li class="{{ 'camiones' == Request::is('camiones*') ? 'active' : '' }}">
                            <a href="{{ url('/camiones') }}">
                                <i class="fas fa-bus"></i>
                                <b> Camiones</b>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ 'datasets' == Request::is('datasets*') ? 'active' : '' }}">
                    <a href="#Pronosticos" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-chart-area"></i>
                        <b>Pronósticos</b>
                    </a>
                    <ul class="collapse list-unstyled" id="Pronosticos">
                        <li class="{{ 'datasets' == Request::is('datasets*') ? 'active' : '' }}">
                            <a href="{{ url('/datasets') }}">
                                <i class="fas fa-database"></i>
                                <b> Datasets</b>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ 'recorridos' == Request::is('recorridos*') ? 'active' : '' }} or
                {{ 'recepciones' == Request::is('recepciones*') ? 'active' : '' }} or
                {{ 'rutas' == Request::is('rutas*') ? 'active' : '' }} or
                {{ 'areasCriticas' == Request::is('areasCriticas*') ? 'active' : '' }} or
                {{ 'horarios' == Request::is('horarios*') ? 'active' : '' }} or
                {{ 'distritos' == Request::is('distritos*') ? 'active' : '' }} or
                {{ 'zonas' == Request::is('zonas*') ? 'active' : '' }} or
                {{ 'establecimientos' == Request::is('establecimientos*') ? 'active' : '' }} or
                {{ 'redes' == Request::is('redes*') ? 'active' : '' }} or
                {{ 'basuras' == Request::is('basuras*') ? 'active' : '' }}">
                    <a href="#Residuos" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-recycle"></i>
                        <b>Gestión de Residuos</b>
                    </a>
                    <ul class="collapse list-unstyled" id="Residuos">
                        <li class="{{ 'recorridos' == Request::is('recorridos*') ? 'active' : '' }}">
                            <a href="{{ url('/recorridos') }}">
                                <i class="fa fa-list"></i>
                                <b> Recorridos</b>
                            </a>
                        </li>
                        <li class="{{ 'recepciones' == Request::is('recepciones*') ? 'active' : '' }}">
                            <a href="{{ url('/recepciones') }}">
                                <i class="fas fa-file"></i>
                                <b> Recepciones</b>
                            </a>
                        </li>
                        <li class="{{ 'rutas' == Request::is('rutas*') ? 'active' : '' }}">
                            <a href="{{ url('/rutas') }}">
                                <i class="fas fa-road"></i>
                                <b> Rutas</b>
                            </a>
                        </li>
                        <li class="{{ 'areasCriticas' == Request::is('areasCriticas*') ? 'active' : '' }}">
                            <a href="{{ url('/areasCriticas') }}">
                                <i class="fas fa-map"></i>
                                <b> Areas Críticas</b>
                            </a>
                        </li>
                        <li class="{{ 'horarios' == Request::is('horarios*') ? 'active' : '' }}">
                            <a href="{{ url('/horarios') }}">
                                <i class="fas fa-clock"></i>
                                <b> Horarios</b>
                            </a>
                        </li>
                        <li class="{{ 'distritos' == Request::is('distritos*') ? 'active' : '' }}">
                            <a href="{{ url('/distritos') }}">
                                <i class="fas fa-globe"></i>
                                <b> Distritos</b>
                            </a>
                        </li>
                        <li class="{{ 'zonas' == Request::is('zonas*') ? 'active' : '' }}">
                            <a href="{{ url('/zonas') }}">
                                <i class="fas fa-chart-pie"></i>
                                <b> Zonas</b>
                            </a>
                        </li>
                        <li class="{{ 'establecimientos' == Request::is('establecimientos*') ? 'active' : '' }}">
                            <a href="{{ url('/establecimientos') }}">
                                <i class="fas fa-building"></i>
                                <b> Establecimientos</b>
                            </a>
                        </li>
                        <li class="{{ 'redes' == Request::is('redes*') ? 'active' : '' }}">
                            <a href="{{ url('/redes') }}">
                                <i class="fas fa-hashtag"></i>
                                <b> Redes</b>
                            </a>
                        </li>
                        <li class="{{ 'basuras' == Request::is('basuras*') ? 'active' : '' }}">
                            <a href="{{ url('/basuras') }}">
                                <i class="fas fa-trash"></i>
                                <b> Basuras</b>
                            </a>
                        </li>
                        <li class="{{ 'areasCriticas' == Request::is('areasCriticas*') ? 'active' : '' }}">
                            <a href="{{ url('/barrios') }}">
                                <i class="fas fa-map"></i>
                                <b> Barrios</b>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--
                <li class="{{ 'alarmas' == Request::is('alarmas*') ? 'active' : '' }}">
                    <a href="{{ url('/alarmas') }}">
                        <i class="fas fa-bell"></i>
                        <b> Alarmas</b>
                    </a>
                </li>
            -->
                <li class="{{ 'reclamos' == Request::is('reclamos*') ? 'active' : '' }}">
                    <a href="{{ url('/reclamos') }}">
                        <i class="fas fa-exclamation"></i>
                        <b> Reclamos</b>
                    </a>
                </li>
        
            </ul>
        </nav>
    </div>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
