@extends('layouts.app-master')
@section('content')
    <div class="card mt-4">
        <div class="card-header d-inline-flex">
            <h1>Gráfica - @if ($nombres != null)
                    @foreach ($nombres as $nombre)
                        {{ $nombre }}
                    @endforeach
                @endif
            </h1>
        </div>
        <div class="card-header d-inline-flex">
            <a href="{{ url('/datasets') }}" class="btn btn-primary ml-auto">
                <i class="fas fa-arrow-left"></i>
                Volver</a>
        </div>
        <div class="card-body">
            <!-- Crea el lienzo para la gráfica -->
            <canvas id="myChart"></canvas>
        </div>
        <div class="card-footer">
        </div>
    </div>
    <!-- Incluye la biblioteca de Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Obtiene los datos preparados para Chart.js
        var dates = <?php echo json_encode($timestamps); ?>;
        var quantities = <?php echo json_encode($values); ?>;
        var nombre = <?php echo json_encode($nombres); ?>;
        // Configura y dibuja la gráfica
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: nombre,
                    data: quantities,
                    borderColor: 'red',
                    fill: true,
                    backgroundColor: '#ffc4c4', // Color y transparencia del área
                }, ]
            },
            options: {
                // Personaliza las opciones de la gráfica según tus necesidades
            }
        });
    </script>
@endsection
