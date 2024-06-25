@extends('layouts.app-master')
@section('content')

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Street Map</title>

    <link rel="stylesheet" href="{{ asset('css/leaflet.css') }}" />
    <script src="{{ asset('js/leaflet.js') }}"></script>
</head>
<body>
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
                        <th>Cliente</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reclamos as $reclamo)
                        <tr>
                            <td>{{ $reclamo->id }}</td>
                            <td>{{ $reclamo->descripcion }}</td>
                            <td>{{ $reclamo->fechaHora }}</td>
                            <td>{{ $reclamo->coordenada }}</td>
                            <td>{{ $reclamo->cliente->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $reclamos->links() }}
        </div>
    </div>

    <script>
        // Define un icono personalizado usando la ruta relativa desde public
        let customIcon = L.icon({
            iconUrl: '{{ asset("img/map.png") }}',
            iconSize: [40, 41],
            iconAnchor: [40, 41],
            popupAnchor: [12, 34]
        });

        let map = L.map('mi_mapa').setView([-17.78327916790587, -63.182134246564736], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '<a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        @foreach($reclamos as $reclamo)
            L.marker([{{ $reclamo->coordenada }}], { icon: customIcon }).addTo(map)
                .bindPopup("<strong>Cliente:</strong> {{ $reclamo->cliente->name }}<br><strong>Descripción:</strong> {{ $reclamo->descripcion }}");
        @endforeach
    </script>
</body>
@endsection
