<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\http\Requests\SensoryFormRequest;
use App\Models\Sensory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class SensoryController extends Controller
{
    public function index()
    {
        return view('home.sensory.index');
    }

    public function list_ajax()
    {
        //Usuario
        $user = Auth::user();

        $data = DB::table('sensorys')
            ->select('sensorys.*')
            ->where('sensorys.user_id', '=', $user->id)
            ->orderBy('id', 'desc')->get();

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
    public function create()
    {
        return view('home.sensory.create');
    }

    public function store(SensoryFormRequest $request)
    {
        $validatedData = $request->validated();
        $sensory = new Sensory;
        $sensory->sensory1 = $validatedData['sensory1'];
        $sensory->sensory2 = $validatedData['sensory2'];
        $sensory->sensory3 = $validatedData['sensory3'];
        $sensory->sensory4 = $validatedData['sensory4'];
        $sensory->sensory5 = $validatedData['sensory5'];
        //Usuario
        $user = Auth::user();
        $sensory->user_id = $user->id;
        $sensory->save();

        return redirect('home/sensory')->with('message', 'Dato agregado Correctamente');
    }


    //API 
    public function list_ajax_sensory()
    {
        //Usuario
        $user = Auth::user();

        $data = DB::table('sensorys')
            ->select('sensorys.*')
            ->orderBy('id', 'desc')->get();

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
    public function save_ajax_sensory(Request $request)
    {
        //validar Formulario
        $validator = Validator::make($request->all(), [
            'sensory1' => 'required',
            'sensory2' => 'required',
            'sensory3' => 'required',
            'sensory4' => 'required',
            'sensory5' => 'required',
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        // Guardar el coche
        $waterpump = new Sensory();

        $waterpump->sensory1 = $request->input('sensory1');
        $waterpump->sensory2 = $request->input('sensory2');
        $waterpump->sensory3 = $request->input('sensory3');
        $waterpump->sensory4 = $request->input('sensory4');
        $waterpump->sensory5 = $request->input('sensory5');
        $waterpump->user_id = $request->input('user_id');

        $waterpump->save();

        if ($waterpump) {
            $array = array(
                'message' => 'Registrado Correctamente',
                'code' => 200,
                'error' => false,
            );
        } else {
            $array = array(
                'message' => 'Error al eliminar',
                'code' => 500,
                'error' => true
            );
        }
        return response()->json($array, 200);
    }
}