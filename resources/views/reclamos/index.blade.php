@extends('layouts.app-master')
@section('content')

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Street Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
</head>
<div class="card mt-3">
    <div class="card-header d-inline-flex">
        <h1>Reclamos</h1>
    </div>
    <div class="table-responsive">
        <div id="mi_mapa" style="width: 100%; height: 500px;"></div>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header">
        <h2>Lista de Reclamos</h2>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Fecha y Hora</th>
                    <th>Coordenada</th>
                    <th>Cliente</th> <!-- Cambiado de ID a Cliente -->
                </tr>
            </thead>
            <tbody>
                @foreach($reclamos as $reclamo)
                    <tr>
                        <td>{{ $reclamo->id }}</td>
                        <td>{{ $reclamo->descripcion }}</td>
                        <td>{{ $reclamo->fechaHora }}</td>
                        <td>{{ $reclamo->coordenada }}</td>
                        <td>{{ $reclamo->cliente->name }}</td> <!-- Mostrar nombre del cliente -->
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $reclamos->links() }} <!-- Mostrar enlaces de paginación -->
    </div>
</div>

<!-- JS PARA FILTAR Y BUSCAR MEDIANTE PAGINADO -->
<script>
    // Define un icono personalizado usando la ruta relativa desde public
    let customIcon = L.icon({
        iconUrl: '{{ asset("img/map.png") }}', // Utiliza la función asset de Blade para la ruta relativa
        iconSize: [40, 41], // tamaño del ícono
        iconAnchor: [40, 41], // punto de anclaje del ícono
        popupAnchor: [12, 34] // ajuste del anclaje del popup
    });

    let map = L.map('mi_mapa').setView([-17.78327916790587, -63.182134246564736], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    @foreach($reclamos as $reclamo)
        L.marker([{{ $reclamo->coordenada }}], { icon: customIcon }).addTo(map)
            .bindPopup("<strong>Cliente:</strong> {{ $reclamo->cliente->name }}<br><strong>Descripción:</strong> {{ $reclamo->descripcion }}");
    @endforeach

    map.on('click', onMapClick);

    function onMapClick(e) {
        alert("Posición: " + e.latlng);
    }
</script>


@endsection
