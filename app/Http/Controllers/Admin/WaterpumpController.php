<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Waterpump;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WaterpumpController extends Controller
{
    public function index()
    {
        return view('home.waterpump.index');
    }

    public function list_ajax()
    {
        //Usuario
        $user = Auth::user();
        $data = DB::table('waterpumps')
            ->select('waterpumps.*')
            ->where('waterpumps.user_id', '=', $user->id)
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
        return view('home.waterpump.create');
    }

    public function store(Request $request)
    {
        //validar Formulario
        $validator = Validator::make($request->all(), [
            'input' => 'required',
            'output' => 'required',
            'constant' => 'required',
            'level' => 'required',
            'value' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        // Guardar el coche
        $waterpump = new waterpump();

        $waterpump->input = $request->input('input');
        $waterpump->output = $request->input('output');
        $waterpump->constant = $request->input('constant');
        $waterpump->level = $request->input('level');
        $waterpump->value = $request->input('value');
        $waterpump->user_id = $request->input('user_id');

        # Usuario
        $user = Auth::user();
        $waterpump->user_id = $user->id;

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

    //API 
    public function list_ajax_waterpump_graphic(Request $request)
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
            $data = DB::table('waterpumps')
                ->select('waterpumps.*')
                ->where('user_id', '=', 1)
                ->orderBy('id', 'desc')
                ->first();

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
                'code' => 200,
                'data' => ''
            );
        }

        return response()->json($array);
    }

    public function list_ajax_waterpump(Request $request)
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
            $data = DB::table('waterpumps')
                ->select('waterpumps.*')
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
                'code' => 200,
                'data' => ''
            );
        }

        return response()->json($array);
    }

    public function save_ajax_waterpump(Request $request)
    {
        //validar Formulario
        $validator = Validator::make($request->all(), [
            'input' => 'required|numeric|min:0|max:100',
            'output' => 'required|numeric|min:0|max:100',
            'constant' => 'required|numeric|min:0|max:100',
            'level' => 'required|numeric|min:0|max:100',
            'value' => 'required|numeric|min:0|max:100',
            'user_id' => 'required',
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $token = $request->input('token');

        if ($token == "DFC3A7CF4EF6CA9B70E9992CFA00911F") {

            // Guardar el coche
            $waterpump = new waterpump();

            $waterpump->input = $request->input('input');
            $waterpump->output = $request->input('output');
            $waterpump->constant = $request->input('constant');
            $waterpump->level = $request->input('level');
            $waterpump->value = $request->input('value');
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