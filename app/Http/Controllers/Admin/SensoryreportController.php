<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SensoryreportMail;

class SensoryreportController extends Controller
{
    public function index()
    {
        return view('home.sensory.report');
    }

    public function list_ajax(Request $request)
    {
        //validar Formulario
        $validator = Validator::make($request->all(), [
            'begin' => 'required',
            'finish' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $begin = $request->input('begin') . ' 00:00:00';
        $finish = $request->input('finish') . ' 23:59:59';

        $user = \Auth::user();

        $data = DB::table('sensorys as s')
            ->select('s.sensory1', 's.sensory2', 's.sensory3', 's.sensory4', 's.sensory5', 's.created_at')
            ->where('s.user_id', '=', $user->id)
            ->whereBetween('s.created_at', [$begin, $finish])
            ->orderby('s.id', 'desc')->get();

        if ($data) {
            $array = array(
                'message' => 'Data Found',
                'code' => 200,
                'data' => $data,
            );
        } else {
            $array = array(
                'message' => 'Internal Data error',
                'code' => 500,
                'data' => ''
            );
        }
        return response()->json($array);
    }

    public function list_graphic(request $request)
    {
        try {
            $action = $request->action;
            $start_date = $request->start_date . ' 00:00:00';
            $end_date = $request->end_date . ' 23:59:59';

            $data = [];
            if ($action == 'init_report_graph_line_chart') {
                $data1 = [
                    'name' => 'Sensor 1',
                    'data' => self::get_sensor1($action, $start_date, $end_date)
                ];
                $data2 = [
                    'name' => 'Sensor 2',
                    'data' => self::get_sensor2($action, $start_date, $end_date)
                ];
                $data3 = [
                    'name' => 'Sensor 3',
                    'data' => self::get_sensor3($action, $start_date, $end_date)
                ];
                $data4 = [
                    'name' => 'Sensor 4',
                    'data' => self::get_sensor4($action, $start_date, $end_date)
                ];
                $data5 = [
                    'name' => 'Sensor 5',
                    'data' => self::get_sensor5($action, $start_date, $end_date)
                ];
                $data6 = [
                    'categories' => self::get_date($action, $start_date, $end_date)
                ];

                $data['0'] = $data1;
                $data['1'] = $data2;
                $data['2'] = $data3;
                $data['3'] = $data4;
                $data['4'] = $data5;
                $data['5'] = $data6;
            }
        } catch (\Exception $e) {
            $data['error'] = 'Ha ocurrido un error';
        }

        return response()->json($data);
    }

    public function get_sensor1($action, $start_date, $end_date)
    {
        try {
            if ($action == 'init_report_graph_line_chart') {
                $user = \Auth::user();
                $data = [];

                $sensorys = DB::table('sensorys as s')
                    ->select('s.sensory1')
                    ->where('s.user_id', '=', $user->id)
                    ->whereBetween('s.created_at', [$start_date, $end_date])
                    ->get();

                foreach ($sensorys as $sensory) {
                    array_push($data, floatval($sensory->sensory1));
                }
                return $data;

            }
        } catch (\Exception $e) {
            $data['error'] = 'Ha ocurrido un error';
        }
    }

    public function get_sensor2($action, $start_date, $end_date)
    {
        try {
            if ($action == 'init_report_graph_line_chart') {
                $user = \Auth::user();
                $data = [];

                $sensorys = DB::table('sensorys as s')
                    ->select('s.sensory2')
                    ->where('s.user_id', '=', $user->id)
                    ->whereBetween('s.created_at', [$start_date, $end_date])
                    ->get();

                foreach ($sensorys as $sensory) {
                    array_push($data, floatval($sensory->sensory2));
                }
                return $data;

            }
        } catch (\Exception $e) {
            $data['error'] = 'Ha ocurrido un error';
        }
    }

    public function get_sensor3($action, $start_date, $end_date)
    {
        try {
            if ($action == 'init_report_graph_line_chart') {
                $user = \Auth::user();
                $data = [];

                $sensorys = DB::table('sensorys as s')
                    ->select('s.sensory3')
                    ->where('s.user_id', '=', $user->id)
                    ->whereBetween('s.created_at', [$start_date, $end_date])
                    ->get();

                foreach ($sensorys as $sensory) {
                    array_push($data, floatval($sensory->sensory3));
                }
                return $data;

            }
        } catch (\Exception $e) {
            $data['error'] = 'Ha ocurrido un error';
        }
    }

    public function get_sensor4($action, $start_date, $end_date)
    {
        try {
            if ($action == 'init_report_graph_line_chart') {
                $user = \Auth::user();
                $data = [];

                $sensorys = DB::table('sensorys as s')
                    ->select('s.sensory4')
                    ->where('s.user_id', '=', $user->id)
                    ->whereBetween('s.created_at', [$start_date, $end_date])
                    ->get();

                foreach ($sensorys as $sensory) {
                    array_push($data, floatval($sensory->sensory4));
                }
                return $data;

            }
        } catch (\Exception $e) {
            $data['error'] = 'Ha ocurrido un error';
        }
    }

    public function get_sensor5($action, $start_date, $end_date)
    {
        try {
            if ($action == 'init_report_graph_line_chart') {
                $user = \Auth::user();
                $data = [];

                $sensorys = DB::table('sensorys as s')
                    ->select('s.sensory5')
                    ->where('s.user_id', '=', $user->id)
                    ->whereBetween('s.created_at', [$start_date, $end_date])
                    ->get();

                foreach ($sensorys as $sensory) {
                    array_push($data, floatval($sensory->sensory5));
                }
                return $data;

            }
        } catch (\Exception $e) {
            $data['error'] = 'Ha ocurrido un error';
        }
    }

    public function get_date($action, $start_date, $end_date)
    {
        try {
            if ($action == 'init_report_graph_line_chart') {
                $user = \Auth::user();
                $data = [];

                $sensorys = DB::table('sensorys as s')
                    ->select('s.created_at')
                    ->where('s.user_id', '=', $user->id)
                    ->whereBetween('s.created_at', [$start_date, $end_date])
                    ->get();

                foreach ($sensorys as $sensory) {
                    array_push($data, $sensory->created_at);
                }
                return $data;

            }
        } catch (\Exception $e) {
            $data['error'] = 'Ha ocurrido un error';
        }
    }

    public function report_email(Request $request)
    {
        try {
            //validar Formulario
            $validator = Validator::make($request->all(), [
                'begin' => 'required',
                'finish' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()->all()]);
            }

            $begin = $request->input('begin') . ' 00:00:00';
            $finish = $request->input('finish') . ' 23:59:59';

            $user = \Auth::user();

            $query = DB::table('sensorys as s')
                ->select('s.sensory1', 's.sensory2', 's.sensory3', 's.sensory4', 's.sensory5', 's.created_at')
                ->where('s.user_id', '=', $user->id)
                ->whereBetween('s.created_at', [$begin, $finish])
                ->orderby('s.id', 'desc')->get();

            $data = array(
                'begin' => $begin,
                'finish' => $finish,
                'data' => $query->toArray()
            );

            Mail::to('hola.synho.sac@gmail.com')->send(new SensoryreportMail($data));

            $array = array(
                'message' => 'Correo enviado Correctamente!!',
                'code' => 200,
                'error' => false,
            );
        } catch (\Exception $e) {
            $array = array(
                'message' => 'Error al enviar',
                'code' => 500,
                'error' => $e->getMessage()
            );
        }
        return response()->json($array);
    }
    /*
    public function report_whatsapp(Request $request)
    {
        try {

            //validar Formulario
            $validator = Validator::make($request->all(), [
                'begin' => 'required',
                'finish' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()->all()]);
            }

            $begin = $request->input('begin') . ' 00:00:00';
            $finish = $request->input('finish') . ' 23:59:59';

            $user = \Auth::user();

            $query = DB::table('sensorys as s')
                ->select('s.sensory1', 's.sensory2', 's.sensory3', 's.sensory4', 's.sensory5', 's.created_at')
                ->where('s.user_id', '=', $user->id)
                ->whereBetween('s.created_at', [$begin, $finish])
                ->orderby('s.id', 'desc')->get();


            $date = $begin . ' - ' . $finish;
            $message = "Sensory1 | Sensory2 | Sensory3 | Sensory4 | Sensory5 | Created At"; // Headers

            foreach ($query as $item) {
                $message .= $item->sensory1 . " | " . $item->sensory2 . " | " . $item->sensory3 . " | " . $item->sensory4 . " | " . $item->sensory5 . " | " . $item->created_at;
            }

            $token = 'EAAO7NfOyfqABO0dH7q8SOATvUlVxp6YJtnE6kafGRUNsKVd7u8NZB9PZC8PGRZBBoVauvuQD0BkVo96UpqL8QUFO39SQEgzDI7UH7E7heCy44R7Etn7LRlL7Tk0qk1IOB8jBXZBxc1hDiUofuFAzMXFYxtMHVfhdsozCb0q8OEuHVLepGJFgj0RHQomHFUQB';
            $phoneId = '120058534419147';
            $version = 'v17.0';
            $payload = [
                'messaging_product' => 'whatsapp',
                'to' => '51910583486',
                'type' => 'template',
                'template' => [
                    'name' => 'alerta_reporte',
                    'language' => [
                        'code' => 'es'
                    ],
                    'components' => [
                        [
                            'type' => 'body',
                            'parameters' => [
                                [
                                    'type' => 'text',
                                    'text' => $date,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $message,
                                ],
                            ]
                        ]
                    ]
                ]


            ];

            $message = Http::withToken($token)->post('https://graph.facebook.com/' . $version . '/' . $phoneId . '/messages', $payload)->throw()->json();

            return response()->json(
                [
                    'message' => 'Whatsapp enviado Correctamente!!',
                    'code' => 200,
                    'data' => $message
                ]
            );

        } catch (\Exception $e) {
            return response()->json(
                [
                    'message' => $e->getMessage(),
                    'code' => 500,
                    'error' => true,
                ],
                500
            );
        }
    }*/
}