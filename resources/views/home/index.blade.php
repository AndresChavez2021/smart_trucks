@extends('layouts.app-master')

@section('content')
    <h1>Smart Trucks</h1>
    @auth
        <p>Bienvenido {{ auth()->user()->name ?? auth()->user()->email }}, estás autenticado en la página.</p>

        <div class="container">
            <div class="row">
                <!-- Tarjeta Total Usuarios -->
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-header">Total Usuarios</div>
                        <div class="card-body">
                            <h5 class="card-title">@isset($totalUsuarios){{ $totalUsuarios }}@endisset</h5>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta Total Clientes -->
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                        <div class="card-header">Total Clientes</div>
                        <div class="card-body">
                            <h5 class="card-title">@isset($totalClientes){{ $totalClientes }}@endisset</h5>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta Total Empleados -->
                <div class="col-md-4">
                    <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                        <div class="card-header">Total Empleados</div>
                        <div class="card-body">
                            <h5 class="card-title">@isset($totalEmpleados){{ $totalEmpleados }}@endisset</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>

        <div id="consulta" style="height: 500px; min-width: 310px; max-width: 800px; margin: 0 auto;"></div>
      

        <!-- Incluir librerías de Highcharts -->
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>




        


        <!-- Configurar el gráfico de barras con los datos proporcionados desde el controlador -->
        <script>
            var jsonData = {!! $jsonData !!};

            Highcharts.chart('consulta', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Cantidad de Basura Recepcionada por Categoria'
                },
                subtitle: {
                    text: 'Año Actual'
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        autoRotation: [-45, -90],
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Toneladas'
                    }
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: 'Cantidad: <b>{point.y:.1f} ton</b>'
                },
                series: [{
                    name: 'Cantidad',
                    colorByPoint: true,
                    data: jsonData,
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        inside: true,
                        verticalAlign: 'top',
                        format: '{point.y:.1f}', // una décima
                        y: 10, // 10 píxeles desde la parte superior
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                }]
            });
        </script>

     
       
@endauth
@endsection
