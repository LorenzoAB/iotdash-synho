<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Waterpump;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class waterpumpgraphicController extends Controller
{
    public function index()
    {
        return view('home.waterpump.graphic');
    }

    public function list_graphic()
    {
        $user = Auth::user();
        $data = DB::table('waterpumps')
            ->select('waterpumps.*')
            ->where('user_id', '=', $user->id)
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
        return response()->json($array);
    }


}
