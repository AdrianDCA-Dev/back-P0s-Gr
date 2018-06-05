<?php

namespace App\Http\Controllers\ApiController;

use App\Perfil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PerfilController extends Controller
{
    //

    public function store(Request $request)
    {
        $perfil=new Perfil();
        $perfil->nombre=trim($request->nombre);
        $perfil->valido=trim($request->valido);
        $perfil->save();
        return response()->json(compact('perfil'));
    }
}
