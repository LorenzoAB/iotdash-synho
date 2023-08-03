<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        //validar Formulario
        $validator = Validator::make($request->all(), [
            'sensory1' => 'required|numeric|min:0|max:100',
            'sensory2' => 'required|numeric|min:0|max:100',
            'sensory3' => 'required|numeric|min:0|max:100',
            'sensory4' => 'required|numeric|min:0|max:100',
            'sensory5' => 'required|numeric|min:0|max:100',
        ]);
        //Esto es para que lleve donde esta el formulario
        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        $sensory = new sensory();

        $sensory->sensory1 = $request->input('sensory1');
        $sensory->sensory2 = $request->input('sensory2');
        $sensory->sensory3 = $request->input('sensory3');
        $sensory->sensory4 = $request->input('sensory4');
        $sensory->sensory5 = $request->input('sensory5');

        //Usuario
        $user = \Auth::user();
        $sensory->user_id = $user->id;

        $sensory->save();

        return redirect('home/sensory')->with('message', 'Dato agregado Correctamente');
    }


    //API 
    public function list_ajax_sensory(Request $request)
    {

        $token = $request->query('token');

        // validar Formulario
        $validator = Validator::make(['token' => $token], [
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        if ($token == "DFC3A7CF4EF6CA9B70E9992CFA00911F") {
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
        } else {
            $array = array(
                'message' => 'Token Incorrecto',
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
            'sensory1' => 'required|numeric|min:0|max:100',
            'sensory2' => 'required|numeric|min:0|max:100',
            'sensory3' => 'required|numeric|min:0|max:100',
            'sensory4' => 'required|numeric|min:0|max:100',
            'sensory5' => 'required|numeric|min:0|max:100',
            'user_id' => 'required',
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $token = $request->input('token');

        if ($token == "DFC3A7CF4EF6CA9B70E9992CFA00911F") {

            // Guardar el coche
            $sensory = new Sensory();

            $sensory->sensory1 = $request->input('sensory1');
            $sensory->sensory2 = $request->input('sensory2');
            $sensory->sensory3 = $request->input('sensory3');
            $sensory->sensory4 = $request->input('sensory4');
            $sensory->sensory5 = $request->input('sensory5');
            $sensory->user_id = $request->input('user_id');

            $sensory->save();

            if ($sensory) {
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

        } else {
            $array = array(
                'message' => 'Token Incorrecto',
                'code' => 500,
                'data' => ''
            );
        }

        return response()->json($array);
    }
}
