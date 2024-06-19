@extends('layouts.app-master')
@section('content')
    <div class="card mt-4">
        <div class="card-header d-inline-flex">
            <h1>Gráfica Predicción a {{$dias}} Días</h1>
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
        var datesP10 = <?php echo json_encode($datesP10s[0]); ?>;
        var quantitiesP10 = <?php echo json_encode($quantitiesP10s[0]); ?>;
        // Repite los pasos anteriores para los otros conjuntos de datos (P50 y P90)
        var datesP50 = <?php echo json_encode($datesP50s[0]); ?>;
        var quantitiesP50 = <?php echo json_encode($quantitiesP50s[0]); ?>;
        //
        var datesP90 = <?php echo json_encode($datesP90s[0]); ?>;
        var quantitiesP90 = <?php echo json_encode($quantitiesP90s[0]); ?>;
        // Configura y dibuja la gráfica
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: datesP10,
                datasets: [{
                        label: 'P10',
                        data: quantitiesP10,
                        borderColor: 'red',
                        fill: true,
                        backgroundColor: '#ffc4c4',
                    },
                    // Repite para los otros conjuntos de datos (P50 y P90)
                    {
                        label: 'P50',
                        data: quantitiesP50,
                        borderColor: 'green',
                        fill: true,
                        backgroundColor: '#b9dbb0',
                    },
                    {
                        label: 'P90',
                        data: quantitiesP90,
                        borderColor: 'blue',
                        fill: true,
                        backgroundColor: '#b9b0db',
                    }
                ]
            },
            options: {
                // Personaliza las opciones de la gráfica según tus necesidades
            }
        });
    </script>
@endsection
