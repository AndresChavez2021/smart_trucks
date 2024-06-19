<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Http\Requests\StoreDatasetRequest;
use App\Http\Requests\UpdateDatasetRequest;
use App\Models\Basura;
use App\Models\Distrito;
use App\Models\establecimiento;
use App\Models\Horario;
use App\Models\Recepcion;
use App\Models\Ruta;
use App\Models\Zona;
use Aws\Exception\AwsException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Aws\ForecastService\ForecastServiceClient;
use Aws\ForecastQueryService\ForecastQueryServiceClient;
use Aws\S3\S3Client;
use Carbon\Carbon;
use DateTime;
use Exception;

date_default_timezone_set('America/La_Paz');

class DatasetController extends Controller
{
    protected $forecast;
    protected $forecastQuery;
    protected $s3Client;

    public function __construct()
    {
        $this->forecast = new ForecastServiceClient([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        $this->s3Client = new S3Client([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        $this->forecastQuery = new ForecastQueryServiceClient([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datasets = Dataset::select('*')->orderBy('id', 'ASC');
        $limit = (isset($request->limit)) ? $request->limit : 10;
        if (isset($request->search)) {
            $datasets = $datasets->where('id', 'like', '%' . $request->search . '%')
                ->orWhere('nombres', 'like', '%' . $request->search . '%');
        }
        $datasets = $datasets->paginate($limit)->appends($request->all());
        return view('datasets.index', compact('datasets'));
    }

    public function query($id)
    {
        $basuras = Basura::get();
        $establecimientos = establecimiento::get();
        $distritos = Distrito::get();
        $zonas = Zona::get();
        $horarios = Horario::get();
        $rutas = Ruta::get();
        return view('datasets.query', compact('basuras', 'establecimientos', 'distritos', 'zonas', 'horarios', 'rutas'));
    }

    public function queryStore(Request $request)
    {
        $names = [];
        $id_basura = $request->input('id_basura');
        //$id_establecimiento = $request->input('id_establecimiento');
        $id_distrito = $request->input('id_distrito');
        //$id_zona = $request->input('id_zona');
        //$id_horario = $request->input('id_horario');
        /*$id_ruta = $request->input('id_ruta');*/
        $fecha_ini = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');
        $recorrido = Recepcion::query();
        if ($id_basura != '') {
            $basura = Basura::findOrFail($id_basura);
            array_push($names, 'Basura: ');
            array_push($names, $basura->tipo);
            $recorrido = $recorrido->where('id_basura', $id_basura);
        }
        /*if ($id_zona != '') {
            $zona = Zona::findOrFail($id_zona);
            array_push($names, 'Zona: ');
            array_push($names, $zona->nombre);
            $recorrido = $recorrido->join('recorridos', 'recepcions.id_recorrido', '=', 'recorridos.id')
                ->join('rutas', 'recorridos.id_ruta', '=', 'rutas.id')
                ->join('establecimientos', 'rutas.id', '=', 'establecimientos.id_ruta')
                ->join('distritos', 'establecimientos.id_distrito', '=', 'distritos.id')
                ->join('zonas', 'distritos.id_zona', '=', 'zonas.id')->where('zonas.id', $id_zona);
        }*/
        if ($id_distrito != '') {
            $distrito = Distrito::findOrFail($id_distrito);
            array_push($names, 'Distrito: ');
            array_push($names, $distrito->nombre);
            $recorrido = $recorrido->join('recorridos', 'recepcions.id_recorrido', '=', 'recorridos.id')
                ->join('rutas', 'recorridos.id_ruta', '=', 'rutas.id')
                ->join('establecimientos', 'rutas.id', '=', 'establecimientos.id_ruta')
                ->join('distritos', 'establecimientos.id_distrito', '=', 'distritos.id')->where('distritos.id', $id_distrito);
        }
        /*if ($id_establecimiento != '') {
            $establecimiento = establecimiento::findOrFail($id_establecimiento);
            array_push($names, 'Establecimiento: ');
            array_push($names, $establecimiento->nombre);
            $recorrido = $recorrido->join('recorridos', 'recepcions.id_recorrido', '=', 'recorridos.id')
                ->join('rutas', 'recorridos.id_ruta', '=', 'rutas.id')
                ->join('establecimientos', 'rutas.id', '=', 'establecimientos.id_ruta')->where('establecimientos.id', $id_establecimiento);
        }*/
        /*if ($id_ruta != '') {
            $ruta = Ruta::findOrFail($id_ruta);
            array_push($names, 'Ruta: ');
            array_push($names, $ruta->nombre);
            $recorrido = $recorrido->join('recorridos', 'recepcions.id_recorrido', '=', 'recorridos.id')
                ->join('rutas', 'recorridos.id_ruta', '=', 'rutas.id')->where('rutas.id', $id_ruta);
        }*/
        /*if ($id_horario != '') {
            $horario = Horario::findOrFail($id_horario);
            array_push($names, 'Horario: ');
            array_push($names, $horario->dia_semana);
            $recorrido = $recorrido->join('recorridos', 'recepcions.id_recorrido', '=', 'recorridos.id')
                ->join('rutas', 'recorridos.id_ruta', '=', 'rutas.id')->where('rutas.id', $id_ruta)
                ->join('horarios', 'rutas.id_horario', '=', 'horarios.id')->where('horarios.id', $id_horario);
        }*/
        $recorrido = $recorrido->select('recepcions.id', 'recepcions.fechaHora', 'recepcions.cantidad')->where('recepcions.fechaHora', '>=', $fecha_ini)->where('recepcions.fechaHora', '<=', $fecha_fin)
            ->orderBy('recepcions.fechaHora', 'ASC')->get();
        // CSV
        $filename = date('Y-m-d H:i:s') . '.csv';
        $filename = str_replace([':', ' ', '-'], '_', $filename);
        $file = fopen($filename, 'w');
        fputcsv($file, ['timestamp', 'target_value', 'item_id']);
        foreach ($recorrido as $rec) {
            $dateTime = new DateTime($rec->fechaHora);
            $timestamps = $dateTime->format('Y-m-d H:i:s');
            fputcsv($file, [$timestamps, $rec->cantidad, 1]);
        }
        fclose($file);
        // Guardar el archivo en S3
        $disk = Storage::disk('s3');
        $disk->put('datasets/' . $filename, file_get_contents($filename), 'public');
        // Eliminar el archivo local después de guardarlo en S3
        unlink($filename);
        // Obtener la URL permanente del archivo
        $carpeta = 'datasets/' . $filename;
        $enlace = $disk->url($carpeta);
        Dataset::create([
            'url' => $enlace,
            'carpeta' => $carpeta,
            'filename' => $filename,
            'nombres' => json_encode($names)
        ]);
        return redirect(route('datasets.index'));
    }

    function str_putcsv($data, $delimiter = ',', $enclosure = '"')
    {
        $str = '';
        foreach ($data as $field) {
            $str .= $enclosure . str_replace($enclosure, $enclosure . $enclosure, $field) . $enclosure . $delimiter;
        }
        return rtrim($str, $delimiter);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*$response = $this->forecastQuery->queryForecast([
            'EndDate' => '2023-03-01T00:00:00',
            'Filters' => [
                'item_id' => '1'
            ],
            'ForecastArn' => 'arn:aws:forecast:us-east-1:630886284847:forecast/forecast',
            'StartDate' => '2022-12-30T00:00:00',
        ]);
        $forecastData = $response->get('Forecast');
        $p10s = $forecastData['Predictions']['p10'];
        $datesP10s[] = array_column($p10s, 'Timestamp');
        $quantitiesP10s[] = array_column($p10s, 'Value');
        $p50s = $forecastData['Predictions']['p50'];
        $datesP50s[] = array_column($p50s, 'Timestamp');
        $quantitiesP50s[] = array_column($p50s, 'Value');
        $p90s = $forecastData['Predictions']['p90'];
        $datesP90s[] = array_column($p90s, 'Timestamp');
        $quantitiesP90s[] = array_column($p90s, 'Value');
        return view('datasets.create', compact('datesP10s', 'quantitiesP10s', 'datesP50s', 'quantitiesP50s', 'datesP90s', 'quantitiesP90s'));*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDatasetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataset = Dataset::findOrFail($request->id_dataset);
        $fechaIni = Carbon::parse('2022-12-30'); // Fecha inicial
        $fechaFin = $fechaIni->addDays($request->cantidad);
        $dias = $request->cantidad;
        // Obtener la nueva fecha en un formato específico
        $fechaFin = $fechaFin->format('Y-m-d');
        try {
            $response = $this->forecastQuery->queryForecast([
                'EndDate' => $fechaFin . 'T00:00:00',
                'Filters' => [
                    'item_id' => '1'
                ],
                'ForecastArn' => $dataset->forecastArn,
                'StartDate' => '2022-12-30T00:00:00',
            ]);
            $forecastData = $response->get('Forecast');
            $p10s = $forecastData['Predictions']['p10'];
            $datesP10s[] = array_column($p10s, 'Timestamp');
            $quantitiesP10s[] = array_column($p10s, 'Value');
            $p50s = $forecastData['Predictions']['p50'];
            $datesP50s[] = array_column($p50s, 'Timestamp');
            $quantitiesP50s[] = array_column($p50s, 'Value');
            $p90s = $forecastData['Predictions']['p90'];
            $datesP90s[] = array_column($p90s, 'Timestamp');
            $quantitiesP90s[] = array_column($p90s, 'Value');
            return view('datasets.create', compact('datesP10s', 'quantitiesP10s', 'datesP50s', 'quantitiesP50s', 'datesP90s', 'quantitiesP90s', 'dias'));
        } catch (AwsException $e) {
            return redirect()->route('datasets.index')->with('danger', $e->getMessage());
        }catch (Exception $e) {
            // Maneja otras excepciones generales
            return redirect()->route('datasets.index')->with('danger', $e->getMessage());
            // Realiza acciones para manejar el error de manera general, como registrar, notificar o manejar la excepción
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dataset  $dataset
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataset = Dataset::findOrFail($id);
        $nombres = json_decode($dataset->nombres);
        $result = $this->s3Client->getObject([
            'Bucket' => env('AWS_BUCKET'),
            'Key'    => $dataset->carpeta,
        ]);
        $csvContents = $result['Body']->getContents();
        //dd($csvContents);
        $lines = explode("\n", $csvContents);
        $headers = str_getcsv(array_shift($lines));
        $timestamps = [];
        $values = [];
        foreach ($lines as $line) {
            if (trim($line) !== '') {
                $row = str_getcsv(trim($line), ',', '"');
                $entry = array_combine($headers, $row);

                $timestamps[] = $entry['timestamp'];
                $values[] = $entry['target_value'];
            }
        }
        return view('datasets.show', compact('timestamps', 'values', 'nombres'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dataset  $dataset
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataset = Dataset::findOrFail($id);
        $name = str_replace('.csv', '', $dataset->filename);
        $response = $this->forecast->createDatasetGroup([
            'DatasetGroupName' => 'DatasetGroup' . $name,
            'Domain' => 'CUSTOM'
        ]);
        $DatasetGroupArn = $response->get('DatasetGroupArn');
        /*$response = $this->forecast->createDataset([
            'DatasetName' => 'Dataset' . $name,
            'DatasetType' => 'TARGET_TIME_SERIES',
            'Domain' => 'CUSTOM',
            'Schema' => [
                'Attributes' => [
                    [
                        'AttributeName' => 'timestamp',
                        'AttributeType' => 'string'
                    ],
                    [
                        'AttributeName' => 'target_value',
                        'AttributeType' => 'string'
                    ],
                    [
                        'AttributeName' => 'item_id',
                        'AttributeType' => 'string'
                    ]
                ]
            ],
        ]);
        $DatasetArn = $response->get('DatasetArn');
        $response = $this->forecast->createDatasetImportJob([
            'DatasetArn' => $DatasetArn,
            'DatasetImportJobName' => 'DatasetImportJob' . $name,
            'DataSource' => [
                'S3Config' => [
                    [
                        'Path' => 's3://bucket-dataset-science/' . $dataset->carpeta,
                        'RoleArn' => 'arn:aws:iam::630886284847:role/service-role/AmazonForecast-ExecutionRole-1689045127457'
                    ]
                ]
            ],
        ]);
        $DatasetImportJobArn = $response->get('DatasetImportJobArn');
        /*
        $response = $this->forecast->createPredictor([
            'FeaturizationConfig' => [
                'ForecastFrequency' => '1D'
            ],
            'ForecastHorizon' => '10',
            'InputDataConfig' => [
                'DatasetGroupArn' => $DatasetGroupArn
            ],
            'PredictorName' => 'Predictor'.$name,

        ]);
        $PredictorArn = $response->get('PredictorArn');
        $response = $this->forecast->createForecast([
            'ForecastName' => 'Forecast'.$name,
            'PredictorArn' => $PredictorArn,
        ]);
        $ForecastArn = $response->get('ForecastArn');
        $dataset->forecastArn = $ForecastArn;
        $dataset->save();
        */
        return redirect()->route('datasets.index')->with('mensaje', 'Éxito');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDatasetRequest  $request
     * @param  \App\Models\Dataset  $dataset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dataset  $dataset
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataset = Dataset::findOrFail($id);
        try {
            $carpeta = $dataset->carpeta;
            $dataset->delete();
            Storage::disk('s3')->delete($carpeta);
            return redirect()->route('datasets.index')->with('message', 'Se han borrado los datos correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('datasets.index')->with('danger', 'Datos relacionados, imposible borrar dato.');
        }
    }
}
