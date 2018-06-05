<?php

namespace App\Http\Controllers\ApiController;

use App\Calendario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalendarioController extends Controller
{
    //
    public function registrarCalendario(Request $request){
        $calendario=new Calendario();
        $calendario->fecha=trim($request->fecha);
        $calendario->horaInicio=trim($request->horaInicio);
        $calendario->horaFinal=trim($request->horaFinal);
        $calendario->detalle_cronograma()->associate($request->get('detalleCron_id'));
    }



}
