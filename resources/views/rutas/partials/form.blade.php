@csrf
<div class="row">
    <div class="col-12">
        <div class="form-floating">
            <input type="text" placeholder="nombre" class="form-control" name="nombre"
                value="{{ isset($ruta) ? $ruta->nombre : old('nombre') }}">
            <label>Nombre</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="text" placeholder="descripcion" class="form-control" name="descripcion"
                value="{{ isset($ruta) ? $ruta->descripcion : old('descripcion') }}">
            <label>Descripción</label>
        </div>
    </div>
    <div class="col-12">
        <br>
        <label>
            <h5>Elegir un Horario</h5>
        </label>
        <select name="id_horario" class="form-control">
            <option value=""> Seleccione Un Horario... </option>
            @foreach ($horarios as $horario)
                <option value="{{ $horario->id }}" @if ((isset($ruta->id_horario) ? $ruta->id_horario : old('id_horario')) == $horario->id) selected @endif>
                    {{ $horario->dia_semana }} - {{ $horario->hora_inicio }} - {{ $horario->hora_fin }}
                </option>
            @endforeach
        </select>
        <br>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="hidden" name="coordenadas" value="" id="coordenadas">
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="hidden" name="origen" value="" id="origen">
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="hidden" name="destino" value="" id="destino">
        </div>
    </div>
</div>
<!--------------------------------------------------------------------------------->

<div id="map" style="width: 100%; height: 400px;"></div>

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&callback=initMap&v=weekly" defer>
</script>

<script>
    let markers = [];

    function initMap() {
        const map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: -17.7799086353198,
                lng: -63.18265591059412
            },
            zoom: 15,
            clickableIcons: false
        });

        const points = [
            <?php
            // Supongamos que tienes un arreglo de objetos stdClass llamado $sucursales
            foreach ($puntos as $punto) {
                echo '{ lat: ' . $punto->lat . ', lng: ' . $punto->lng . '},';
            }
            ?>
        ];

        if (points.length != 0) {
            map.setCenter(points[0]);
        }

        if (points.length > 1) {
            markers[0] = new google.maps.Marker({
                position: new google.maps.LatLng(points[0]['lat'], points[0]['lng']),
                map: map,
                title: 'Origen'
            });

            markers[1] = new google.maps.Marker({
                position: new google.maps.LatLng(points[points.length - 1]['lat'], points[points.length - 1]
                    ['lng']),
                map: map,
                title: 'Destino'
            });

            const polylinePath = points.map(function(point) {
                return new google.maps.LatLng(point.lat, point.lng);
            });

            polyline = new google.maps.Polyline({
                path: polylinePath,
                strokeColor: "#00000",
                strokeOpacity: 1.0,
                strokeWeight: 2
            });

            polyline.setMap(map);
        } else {
            map.addListener('click', function(event) {
                addMarker(event.latLng, map);
            });

            for (let i = 0; i < points.length; i++) {
                markers[i] = new google.maps.Marker({
                    position: new google.maps.LatLng(points[i]['lat'], points[i]['lng']),
                    map: map
                });
            }
        }
        cargarAreasCriticas(map);
    }

    function addMarker(location, map) {
        const marker = new google.maps.Marker({
            position: location,
            map: map
        });

        markers.push(marker);
    }

    function cargarCoords() {
        let coords = [];
        let origen = [];
        let destino = [];
        for (let i = 0; i < markers.length; i++) {
            const element = markers[i];
            var coord = {
                lat: element.getPosition().lat(),
                lng: element.getPosition().lng()
            };
            coords.push(coord);
        }

        origen = coords[0];
        destino = coords[coords.length - 1];

        if (coords != '') {
            console.log('<>');
            document.getElementById("coordenadas").value = JSON.stringify(coords);
            document.getElementById("origen").value = JSON.stringify(origen);
            document.getElementById("destino").value = JSON.stringify(destino);
        }
    }

    function cargarAreasCriticas(map) {
        <?php
        if (isset($areasCriticas)) {
            $points = json_encode($areasCriticas);
        } else {
            $points = '';
        }
        ?>

        var points = '<?php echo $points; ?>';

        if (points !== '') {
            areasMarkers = [];
            points = JSON.parse(points);
            for (let i = 0; i < points.length; i++) {
                const element = points[i];
                // Crea el marcador
                areasMarkers[i] = new google.maps.Marker({
                    position: new google.maps.LatLng(element.latitud, element.longitud),
                    map: map,
                    icon: {
                        url: '/assets/img/icons/critico.png', // Ruta al archivo de ícono personalizado
                        scaledSize: new google.maps.Size(30, 30), // Tamaño personalizado del ícono
                    }
                });

                var circle = new google.maps.Circle({
                    map: map,
                    center: areasMarkers[i].getPosition(),
                    radius: element.radio,
                    strokeColor: '#000000', // Color del borde del círculo (en este caso, rojo)
                    strokeOpacity: 0.8, // Opacidad del borde del círculo
                    strokeWeight: 2, // Grosor del borde del círculo
                    fillColor: '#000000', // Color de relleno del círculo (en este caso, rojo)
                    fillOpacity: 0.35 // Opacidad del relleno del círculo
                });
            }
        }
    }
</script>
