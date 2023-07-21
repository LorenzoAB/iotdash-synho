<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        $begin = $request->input('begin');
        $finish = $request->input('finish');
        $user = \Auth::user();

        $finish = Carbon::now();
        $finish->format("Y-M-D H:m:s");

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
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $end_date = Carbon::now();
            $end_date->format("Y-M-D H:m:s");

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
                    array_push($data, intval($sensory->sensory1));
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
                    array_push($data, intval($sensory->sensory2));
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
                    array_push($data, intval($sensory->sensory3));
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
                    array_push($data, intval($sensory->sensory4));
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
                    array_push($data, intval($sensory->sensory5));
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

            $begin = $request->input('begin');
            $finish = $request->input('finish');
            $user = \Auth::user();

            $finish = Carbon::now();
            $finish->format("Y-M-D H:m:s");

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
}