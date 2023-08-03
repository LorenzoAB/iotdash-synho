<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Waterpump;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\WaterpumpreportMail;

class waterpumpreportController extends Controller
{
    public function index()
    {
        return view('home.waterpump.report');
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

        $begin = $request->input('begin'). ' 00:00:00';
        $finish = $request->input('finish').' 23:59:59';

        $user = \Auth::user();

        $data = DB::table('waterpumps as w')
            ->select('w.input', 'w.output', 'w.constant', 'w.level', 'w.value', 'w.created_at')
            ->where('w.user_id', '=', $user->id)
            ->whereBetween('w.created_at', [$begin, $finish])
            ->orderby('w.id', 'desc')->get();

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
            $start_date = $request->start_date. ' 00:00:00';
            $end_date = $request->end_date.' 23:59:59';

            $data = [];
            if ($action == 'init_report_graph_line_chart') {
                $data1 = [
                    'name' => 'Input',
                    'data' => self::get_input($action, $start_date, $end_date)
                ];
                $data2 = [
                    'name' => 'Output',
                    'data' => self::get_output($action, $start_date, $end_date)
                ];
                $data3 = [
                    'name' => 'Constant',
                    'data' => self::get_constant($action, $start_date, $end_date)
                ];
                $data4 = [
                    'name' => 'Level',
                    'data' => self::get_level($action, $start_date, $end_date)
                ];
                $data5 = [
                    'name' => 'Real Value',
                    'data' => self::get_value($action, $start_date, $end_date)
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

    public function get_input($action, $start_date, $end_date)
    {
        try {
            if ($action == 'init_report_graph_line_chart') {
                $user = \Auth::user();
                $data = [];

                $waterpumps = DB::table('waterpumps as w')
                    ->select('w.input')
                    ->where('w.user_id', '=', $user->id)
                    ->whereBetween('w.created_at', [$start_date, $end_date])
                    ->get();

                foreach ($waterpumps as $waterpump) {
                    array_push($data, floatval($waterpump->input));
                }
                return $data;

            }
        } catch (\Exception $e) {
            $data['error'] = 'Ha ocurrido un error';
        }
    }

    public function get_output($action, $start_date, $end_date)
    {
        try {
            if ($action == 'init_report_graph_line_chart') {
                $user = \Auth::user();
                $data = [];

                $waterpumps = DB::table('waterpumps as w')
                    ->select('w.output')
                    ->where('w.user_id', '=', $user->id)
                    ->whereBetween('w.created_at', [$start_date, $end_date])
                    ->get();

                foreach ($waterpumps as $waterpump) {
                    array_push($data, floatval($waterpump->output));
                }
                return $data;

            }
        } catch (\Exception $e) {
            $data['error'] = 'Ha ocurrido un error';
        }
    }

    public function get_constant($action, $start_date, $end_date)
    {
        try {
            if ($action == 'init_report_graph_line_chart') {
                $user = \Auth::user();
                $data = [];

                $waterpumps = DB::table('waterpumps as w')
                    ->select('w.constant')
                    ->where('w.user_id', '=', $user->id)
                    ->whereBetween('w.created_at', [$start_date, $end_date])
                    ->get();

                foreach ($waterpumps as $waterpump) {
                    array_push($data, floatval($waterpump->constant));
                }
                return $data;
            }
        } catch (\Exception $e) {
            $data['error'] = 'Ha ocurrido un error';
        }
    }

    public function get_level($action, $start_date, $end_date)
    {
        try {
            if ($action == 'init_report_graph_line_chart') {
                $user = \Auth::user();
                $data = [];

                $waterpumps = DB::table('waterpumps as w')
                    ->select('w.level')
                    ->where('w.user_id', '=', $user->id)
                    ->whereBetween('w.created_at', [$start_date, $end_date])
                    ->get();

                foreach ($waterpumps as $waterpump) {
                    array_push($data, floatval($waterpump->level));
                }
                return $data;
            }
        } catch (\Exception $e) {
            $data['error'] = 'Ha ocurrido un error';
        }
    }

    public function get_value($action, $start_date, $end_date)
    {
        try {
            if ($action == 'init_report_graph_line_chart') {
                $user = \Auth::user();
                $data = [];

                $waterpumps = DB::table('waterpumps as w')
                    ->select('w.value')
                    ->where('w.user_id', '=', $user->id)
                    ->whereBetween('w.created_at', [$start_date, $end_date])
                    ->get();

                foreach ($waterpumps as $waterpump) {
                    array_push($data, floatval($waterpump->value));
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

                $waterpumps = DB::table('waterpumps as w')
                    ->select('w.created_at')
                    ->where('w.user_id', '=', $user->id)
                    ->whereBetween('w.created_at', [$start_date, $end_date])
                    ->get();

                foreach ($waterpumps as $waterpump) {
                    array_push($data, $waterpump->created_at);
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

            $begin = $request->input('begin'). ' 00:00:00';
            $finish = $request->input('finish').' 23:59:59';
    
            $user = \Auth::user();

            $query = DB::table('waterpumps as w')
                ->select('w.input', 'w.output', 'w.constant', 'w.level', 'w.value', 'w.created_at')
                ->where('w.user_id', '=', $user->id)
                ->whereBetween('w.created_at', [$begin, $finish])
                ->orderBy('w.id', 'desc')
                ->get();

            $data = array(
                'begin' => $begin,
                'finish' => $finish,
                'data' => $query->toArray()
            );

            Mail::to('hola.synho.sac@gmail.com')->send(new WaterpumpreportMail($data));

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
        public function list_ajax_report_waterpump_whatsapp(Request $request)
        {
            try {
                //validar Formulario
                $validator = Validator::make($request->all(), [
                    'input' => 'required',
                    'output' => 'required',
                    'constant' => 'required',
                    'level' => 'required',
                    'status' => 'required'
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()->all()]);
                }

                $input = $request->input('input');
                $output = $request->input('output');
                $constant = $request->input('constant');
                $level = $request->input('level');
                $status = $request->input('status');

                $message = 'El valor de entrada es '.$input.' , el valor de salida es '.$output.' , la constante es '.$constant.', el nivel es '.$level.' .';

                $token = 'EAAfVy7RFowUBAAr7Q1W0TCHagWcE21d0GtYeekZAaZC23ZCZA9oCHZAqhIkooFPHf242ZAliSBzzTUIJnto7KdtUIBycZB9OlIcZB8chjb6GIlwttnjyJLuT0AyTqRHLa0Tbe6iFvjnZBRNq21azmZAJdhkCNjDXEuCZB03Ao0p4rhh7hQsgYfDl5sqhxFYZBsZA0j6ReGzevWGB0xAZDZD';
                $phoneId = '120058534419147';
                $version = 'v16.0';
                $payload = [
                    'messaging_product' => 'whatsapp',
                    'to' => '51910583486',
                    'type' => 'template',
                    'template' => [
                        'name' => 'reporte',
                        'language' => [
                            'code' => 'es'
                        ],
                        'components' => [
                            [
                                'type' => 'body',
                                'parameters' => [
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
        }
        */
}