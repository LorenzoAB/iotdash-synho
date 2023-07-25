<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sensory;
use Carbon\Carbon;

class SensorygraphicController extends Controller
{
    public function index()
    {
        return view('home.sensory.graphic');
    }

    public function list_graphic(request $request)
    {
        try
        {
            $action = $request->action;
            $data = [];
            if ($action == 'init_graph_bar_chart') {
                $data = array(
                    'name' => 'Cantidad de Sensores',
                    'showInLegend' => False,
                    'colorByPoint' => True,
                    'data' => self::init_graph_bar_chart(),
                );
            } elseif ($action == 'init_graph_pie_chart') {
                $data = array(
                    'name' => 'Porcentaje',
                    'colorByPoint' => True,
                    'data' => self::init_graph_pie_chart(),
                );
            } elseif ($action == 'init_graph_line_chart') {
                $data1 = [
                    'name' => 'Sensor 1',
                    'data' => self::get_sensor1()
                ];
                $data2 = [
                    'name' => 'Sensor 2',
                    'data' => self::get_sensor2()
                ];
                $data3 = [
                    'name' => 'Sensor 3',
                    'data' => self::get_sensor3()
                ];
                $data4 = [
                    'name' => 'Sensor 4',
                    'data' => self::get_sensor4()
                ];
                $data5 = [
                    'name' => 'Sensor 5',
                    'data' => self::get_sensor5()
                ];
                $data6 = [
                    'categories' => self::get_date()
                ];

                $data['0'] = $data1;
                $data['1'] = $data2;
                $data['2'] = $data3;
                $data['3'] = $data4;
                $data['4'] = $data5;
                $data['5'] = $data6;
            }
            elseif ($action == 'init_graph_guage_sensory1_chart'){
                $data = array(
                    'name' => 'Cantidad',
                    'showInLegend' => False,
                    'colorByPoint' => True,
                    'data' => self::get_gauge_sensor1(),
                );
            }elseif ($action == 'init_graph_guage_sensory2_chart'){
                $data = array(
                    'name' => 'Cantidad',
                    'showInLegend' => False,
                    'colorByPoint' => True,
                    'data' => self::get_gauge_sensor2(),
                );
            }elseif ($action == 'init_graph_guage_sensory3_chart'){
                $data = array(
                    'name' => 'Cantidad',
                    'showInLegend' => False,
                    'colorByPoint' => True,
                    'data' => self::get_gauge_sensor3(),
                );
            }elseif ($action == 'init_graph_guage_sensory4_chart'){
                $data = array(
                    'name' => 'Cantidad',
                    'showInLegend' => False,
                    'colorByPoint' => True,
                    'data' => self::get_gauge_sensor4(),
                );
            }elseif ($action == 'init_graph_guage_sensory5_chart'){
                $data = array(
                    'name' => 'Cantidad',
                    'showInLegend' => False,
                    'colorByPoint' => True,
                    'data' => self::get_gauge_sensor5(),
                );
            }
        }catch (\Exception $e) {
            $data['error'] = 'Ha ocurrido un error';
        }

        return response()->json($data);

    }

    public function init_graph_bar_chart()
    {
        $data = [];
        try {
            $now = Carbon::now();
            $year = $now->year;
            $user = \Auth::user();
            
            for ($month = 1; $month < 13; $month++) {
                $total = \DB::table('sensorys')
                    ->whereYear('created_at', '=', $year)
                    ->whereMonth('created_at', '=', $month)
                    ->where('user_id', '=', $user->id)
                    ->count();

                array_push($data, $total);
            }
        } catch (\Exception $e) {
            return false;
        }

        return $data;
    }

    public function init_graph_pie_chart()
    {
        $data = [];
        $months = [
            "Unknown",
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ];

        try {
            $now = Carbon::now();
            $year = $now->year;
            $user = \Auth::user();

            for ($month = 1; $month < 13; $month++) {
                $total = \DB::table('sensorys')
                    ->whereYear('created_at', '=', $year)
                    ->whereMonth('created_at', '=', $month)
                    ->where('user_id', '=', $user->id)
                    ->count();

                $name = $months[$month];
                if ($total > 0) {
                    array_push(
                        $data,
                        [
                            'name' => $name,
                            'y' => $total
                        ]
                    );
                }
            }
        } catch (\Exception $e) {
            return false;
        }

        return $data;
    }

    public function get_sensor1()
    {
        $user = \Auth::user();
        $data = [];
        $ntotal = \DB::table('sensorys')
                    ->where('user_id', '=', $user->id)
                    ->count();

        if ($ntotal > 10) {
            $nregistro = $ntotal - 10;
        } else {
            $nregistro = 0;
        }

        while($nregistro <= $ntotal){
            $sensorys = \DB::table('sensorys')
                ->select('sensory1')
                ->where('user_id', '=', $user->id)
                ->orderBy('id', 'desc') 
                ->take(10)
                ->get();

            $nregistro++;
        }

        foreach ($sensorys as $sensory) {
            array_push($data, intval($sensory->sensory1));
        }
        return $data;
    }

    public function get_sensor2()
    {
        $user = \Auth::user();
        $data = [];
        $ntotal = \DB::table('sensorys')
                    ->where('user_id', '=', $user->id)
                    ->count();
        

        if ($ntotal > 10) {
            $nregistro = $ntotal - 10;
        } else {
            $nregistro = 0;
        }

        while($nregistro <= $ntotal){
            $sensorys = \DB::table('sensorys')
                ->where('user_id', '=', $user->id)
                ->select('sensory2')
                ->orderBy('id', 'desc') 
                ->take(10)
                ->get();
            $nregistro++;
        }

        foreach ($sensorys as $sensory) {
            array_push($data, intval($sensory->sensory2));
        }
        return $data;
    }

    public function get_sensor3()
    {
        $user = \Auth::user();
        $data = [];
        $ntotal = \DB::table('sensorys')
                    ->where('user_id', '=', $user->id)
                    ->count();

        if ($ntotal > 10) {
            $nregistro = $ntotal - 10;
        } else {
            $nregistro = 0;
        }

        while($nregistro <= $ntotal){
            $sensorys = \DB::table('sensorys')
                ->where('user_id', '=', $user->id)
                ->select('sensory3')
                ->orderBy('id', 'desc') 
                ->take(10)
                ->get();
            $nregistro++;
        }

        foreach ($sensorys as $sensory) {
            array_push($data, intval($sensory->sensory3));
        }
        return $data;
    }

    public function get_sensor4()
    {
        $user = \Auth::user();
        $data = [];
        $ntotal = \DB::table('sensorys')
                    ->where('user_id', '=', $user->id)
                    ->count();

        if ($ntotal > 10) {
            $nregistro = $ntotal - 10;
        } else {
            $nregistro = 0;
        }

        while($nregistro <= $ntotal){
            $sensorys = \DB::table('sensorys')
                ->where('user_id', '=', $user->id)
                ->select('sensory4')
                ->orderBy('id', 'desc') 
                ->take(10)
                ->get();
            $nregistro++;
        }

        foreach ($sensorys as $sensory) {
            array_push($data, intval($sensory->sensory4));
        }
        return $data;
    }

    public function get_sensor5()
    {
        $user = \Auth::user();
        $data = [];
        $ntotal = \DB::table('sensorys')
                    ->where('user_id', '=', $user->id)
                    ->count();

        if ($ntotal > 10) {
            $nregistro = $ntotal - 10;
        } else {
            $nregistro = 0;
        }

        while($nregistro <= $ntotal){
            $sensorys = \DB::table('sensorys')
                ->where('user_id', '=', $user->id)
                ->select('sensory5')
                ->orderBy('id', 'desc') 
                ->take(10)
                ->get();
            $nregistro++;
        }

        foreach ($sensorys as $sensory) {
            array_push($data, intval($sensory->sensory5));
        }
        return $data;
    }

    public function get_date()
    {
        $user = \Auth::user();
        $data = [];
        $ntotal = \DB::table('sensorys')
                    ->where('user_id', '=', $user->id)
                    ->count();

        if ($ntotal > 10) {
            $nregistro = $ntotal - 10;
        } else {
            $nregistro = 0;
        }

        while($nregistro <= $ntotal){
            $sensorys = \DB::table('sensorys')
                ->select('created_at')
                ->where('user_id', '=', $user->id)
                ->orderBy('id', 'desc') 
                ->take(10)
                ->get();
            $nregistro++;
        }

        foreach ($sensorys as $sensory) {
            array_push($data, $sensory->created_at);
        }
        return $data;
    }

    public function get_gauge_sensor1(){
        $user = \Auth::user();
        $data = [];

        $sensorys = \DB::table('sensorys')
            ->select('sensory1')
            ->where('user_id', '=', $user->id)
            ->orderBy('id', 'desc') 
            ->take(1)
            ->get();
        
        foreach ($sensorys as $sensory) {
            array_push($data, intval($sensory->sensory1));
        }
        return $data;
    }
    public function get_gauge_sensor2(){
        $user = \Auth::user();
        $data = [];

        $sensorys = \DB::table('sensorys')
            ->select('sensory2')
            ->where('user_id', '=', $user->id)
            ->orderBy('id', 'desc') 
            ->take(1)
            ->get();
        
        foreach ($sensorys as $sensory) {
            array_push($data, intval($sensory->sensory2));
        }
        return $data;
    }
    public function get_gauge_sensor3(){
        $user = \Auth::user();
        $data = [];

        $sensorys = \DB::table('sensorys')
            ->select('sensory3')
            ->where('user_id', '=', $user->id)
            ->orderBy('id', 'desc') 
            ->take(1)
            ->get();
        
        foreach ($sensorys as $sensory) {
            array_push($data, intval($sensory->sensory3));
        }
        return $data;
    }
    public function get_gauge_sensor4(){
        $user = \Auth::user();
        $data = [];

        $sensorys = \DB::table('sensorys')
            ->select('sensory4')
            ->where('user_id', '=', $user->id)
            ->orderBy('id', 'desc') 
            ->take(1)
            ->get();
        
        foreach ($sensorys as $sensory) {
            array_push($data, intval($sensory->sensory4));
        }
        return $data;
    }
    public function get_gauge_sensor5(){
        $user = \Auth::user();
        $data = [];

        $sensorys = \DB::table('sensorys')
            ->select('sensory5')
            ->where('user_id', '=', $user->id)
            ->orderBy('id', 'desc') 
            ->take(1)
            ->get();
        
        foreach ($sensorys as $sensory) {
            array_push($data, intval($sensory->sensory5));
        }
        return $data;
    }
}
