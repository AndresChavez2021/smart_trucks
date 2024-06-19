@csrf
<div class="row">
    <div class="col-12">
        <div class="form-floating">
            <input type="text" placeholder="latitud" class="form-control" name="latitud"
                value="{{ isset($areaCritica) ? $areaCritica->latitud : old('latitud') }}" id="latitud">
            <label>Latitud</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="text" placeholder="longitud" class="form-control" name="longitud"
                value="{{ isset($areaCritica) ? $areaCritica->longitud : old('longitud') }}" id="longitud">
            <label>Longitud</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="integer" placeholder="radio" class="form-control" name="radio"
                value="{{ isset($areaCritica) ? $areaCritica->radio : old('radio') }}">
            <label>Radio en Metros</label>
        </div>
    </div>
    <div class="col-12">
        <br>
        <label>
            <h5>Elegir un Ruta</h5>
        </label>
        <select name="id_ruta" class="form-control">
            <option value=""> Seleccione Un ruta... </option>
            @foreach ($rutas as $ruta)
                <option value="{{ $ruta->id }}" @if ((isset($areaCritica->id_ruta) ? $areaCritica->id_ruta : old('id_ruta')) == $ruta->id) selected @endif>
                    {{ $ruta->nombre }} - {{ $ruta->descripcion }}
                </option>
            @endforeach
        </select>
        <br>
    </div>
</div>
<!--------------------------------------------------------------------------------->

<div id="map" style="width: 100%; height: 400px;"></div>

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&callback=initMap&v=weekly" defer>
</script>

<script>
    var marker;
    function initMap() {
        const map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: -17.7799086353198,
                lng: -63.18265591059412
            },
            zoom: 15
        });

        <?php
        if (isset($areaCritica)) {
            $point = json_encode($areaCritica);
        } else {
            $point = '';
        }
        ?>

        var point = '<?php echo $point; ?>';
        if (point !== '') {
            point = JSON.parse(point);
            // Crea el marcador
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(point.latitud, point.longitud),
                map: map,
                draggable: true
            });
        } else {
            // Crea el marcador
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(-17.7799086353198, -63.18265591059412),
                map: map,
                draggable: true
            });
        }


        marker.addListener('click', function() {
            document.getElementById("latitud").value = marker.getPosition().lat();
            document.getElementById("longitud").value = marker.getPosition().lng();
        });
    }
</script>
