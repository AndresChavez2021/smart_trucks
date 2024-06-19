@extends('layouts.app-master')
@section('content')
    <div class="card mt-3">
        <div class="card-header d-inline-flex">
            <h1>Datasets</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <a class="navbar-brand">Listar</a>
                        <select class="form-select" id="limit" name="limit">
                            @foreach ([10, 20, 50, 100] as $limit)
                                <option value="{{ $limit }}"
                                    @if (isset($_GET['limit'])) {{ $_GET['limit'] == $limit ? 'selected' : '' }} @endif>
                                    {{ $limit }}</option>
                            @endforeach
                        </select>
                        <?php
                        if (isset($_GET['page'])) {
                            $pag = $_GET['page'];
                        } else {
                            $pag = 1;
                        }
                        if (isset($_GET['limit'])) {
                            $limit = $_GET['limit'];
                        } else {
                            $limit = 10;
                        }
                        $comienzo = $limit;
                        ?>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <a class="navbar-brand">Buscar</a>
                        <input class="form-control mr-sm-2" type="search" id="search" placeholder="Search"
                            aria-label="Search" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}">
                    </div>
                </div>
                <div class="col-1">
                    <a href="{{ route('datasets.query', 1) }}" class="btn btn-primary ml-auto">
                        <i class="fas fa-plus"></i>
                        Consultas</a>
                </div>
                @if ($datasets->total() > 10)
                    {{ $datasets->links() }}
                @endif
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Filename</th>
                            <th>Carpeta</th>
                            <th>Nombres</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $valor = 1;
                        if ($pag != 1) {
                            $valor = $comienzo + 1;
                        }
                        //$valor = 1;
                        ?>
                        @foreach ($datasets as $dataset)
                            <tr>
                                <th scope="row">{{ $valor++ }}</th>
                                <td>{{ $dataset->filename }}</td>
                                <td>{{ $dataset->carpeta }}</td>
                                <td>{{ $dataset->nombres }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        @can('ver-dataset')
                                            <a href="{{ url($dataset->url) }}" class="btn btn-info"><i
                                                    class="fas fa-download"></i></a>
                                        @endcan
                                        @can('editar-dataset')
                                            <a href="{{ route('datasets.edit', $dataset->id) }}" class="btn btn-primary"><i
                                                    class="fas fa-upload"></i></a>
                                        @endcan
                                        <a href="{{ route('datasets.show', $dataset->id) }}" class="btn btn-info"><i
                                                class="fas fa-chart-area"></i></a>
                                        @can('borrar-dataset')
                                            <button type="submit" class="btn btn-danger" form="delete_{{ $dataset->id }}"
                                                onclick="return confirm('¿Estás seguro de eliminar el registro?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <form action="{{ route('datasets.destroy', $dataset->id) }}"
                                                id="delete_{{ $dataset->id }}" method="POST" enctype="multipart/form-data"
                                                hidden>
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endcan
                                        <a href="#" class="btn btn-primary" data-target="#myModal{{ $dataset->id }}"
                                            data-toggle="modal"><i class="fas fa-chart-line"></i></a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal{{ $dataset->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Predecir</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('datasets.store') }}" method="POST"
                                                            enctype="multipart/form-data" id="predict{{$dataset->id}}">
                                                            @csrf
                                                            <!-- Contenido del modal -->
                                                            <div class="form-floating">
                                                                <input type="hidden" value="{{ $dataset->id }}"
                                                                    name="id_dataset">
                                                                <input type="number" name="cantidad"
                                                                    placeholder="Cantidad de Dias a Predecir ..."
                                                                    class="form-control">
                                                                <label>Cantidad de Dias a Predecir...</label>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary"
                                                            form="predict{{$dataset->id}}">Enviar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                </div>
                </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
    </div>
    <div class="card-footer">
        @if ($datasets->total() > 10)
            {{ $datasets->links() }}
        @endif
    </div>
    <!-- JS PARA FILTAR Y BUSCAR MEDIANTE PAGINADO -->
    <Script type="text/javascript">
        $('#limit').on('change', function() {
            window.location.href = "{{ route('datasets.index') }}?limit=" + $(this).val() + '&search=' + $(
                '#search').val()
        })

        $('#search').on('keyup', function(e) {
            if (e.keyCode == 13) {
                window.location.href = "{{ route('datasets.index') }}?limit=" + $('#limit').val() + '&search=' +
                    $(this).val()
            }
        })

        // Escucha el evento 'submit' del formulario
        document.getElementById('myForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita el envío del formulario

            // Realiza aquí las acciones que desees antes de enviar el formulario
            // ...

            // Cierra el modal después de procesar las acciones
            $('#myModal').modal('hide');

            // Envía el formulario manualmente
            this.submit();
        });
    </Script>
@endsection
