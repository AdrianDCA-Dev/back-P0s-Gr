<?php

namespace App\Http\Controllers\ApiController;

use App\Ambiente;
use App\Calendario;
use App\Cronograma;
use App\Detalle_cronograma;
use App\Modulo;
use App\Persona;
use App\Programa_academico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CronogramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cronograma = Cronograma::all();
        $cronograma->each(function ($cronograma){
            $cronograma->programa_academico;
            //$cronograma->detalle_cronograma;
        });
        return response()->json(compact('cronograma'));
    }

    public function detModule($id)
    {
       /* $detalle = Detalle_cronograma::where('cronograma_id', '=', $id and 'vigente', '=', 'Activo')->get();*/
        $detalle = Detalle_cronograma::where('cronograma_id', '=', $id)->get();
        return response()->json(compact('detalle'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$this->validate($request,[
            'duracion' => 'required|string',
            'version' => 'required|integer',
            'fecha' => 'required|date',
            'programa_academico_id' => 'required|integer',
            'modulo_id' => 'required|integer',
            'persona_id' => 'required|integer',
            'ambiente_id' => 'required|integer',
        ]);*/

        /*$cronograma = new Cronograma();
        $cronograma->version = trim($request->version);
        $cronograma->fecha = trim($request->fecha);
        $cronograma->programa_academico()->associate($request->programa_academico_id);
        $cronograma->save();
        $cronograma->programa_academico;

        $detallecronograma = new Detalle_cronograma();
        $detallecronograma->modulo()->associate($request->modulo_id);
        $detallecronograma->cronograma()->associate($cronograma);
        $detallecronograma->persona()->associate($request->persona_id);
        $detallecronograma->ambiente()->associate($request->ambiente_id);
        //fecha del sistema
        $detallecronograma->fechaIni = Carbon::now()->toDateTimeString();
        $detallecronograma->duracion_dc = trim($request->duracion_dc);
        $detallecronograma->grupo = trim($request->grupo);
        //$detallecronograma->vigente = $request->vigente;
        $detallecronograma->vigente = 'Activo';
        $detallecronograma->save();


        $calendarios = json_decode(json_encode($request->calendario));
        foreach ($calendarios as $calendario) {
            $calendar = new Calendario();
            $calendar->fechaCalendario = trim(Carbon::parse($calendario->end)->toDateString());
            $calendar->horaIni = trim(Carbon::parse($calendario->start)->toTimeString());
            $calendar->horaFin = trim(Carbon::parse($calendario->end)->toTimeString());
            $calendar->detalle_cronograma()->associate($detallecronograma);
            $calendar->save();
        }*/
        $cronograma = new Cronograma();
        $cronograma->version = trim($request->version);
        $cronograma->fecha = trim($request->fecha);
        $cronograma->programa_academico()->associate($request->programa_academico_id);
        $cronograma->save();
        $cronograma->programa_academico;

        $detallecronogramas = json_decode(json_encode($request->detallecronograma));

        foreach ($detallecronogramas as $detallecrono) {

          $detallecronograma = new Detalle_cronograma();
          $detallecronograma->modulo()->associate($detallecrono->modulo_id);
          $detallecronograma->cronograma()->associate($cronograma);
          $detallecronograma->persona()->associate($detallecrono->persona_id);
          $detallecronograma->ambiente()->associate($detallecrono->ambiente_id);
          //fecha del sistema
          $detallecronograma->fechaIni = Carbon::now()->toDateTimeString();
          //$detallecronograma->duracion_dc = trim($detallecrono->duracion_dc);
          $detallecronograma->grupo = trim($detallecrono->grupo);
          //$detallecronograma->vigente = $request->vigente;
          $detallecronograma->vigente = 'Activo';
          $detallecronograma->save();

          //$calendarios = json_decode(json_encode($detallecrono->calendario));
          foreach ($detallecrono->calendario as $calendario) {
              $calendar = new Calendario();
              $calendar->fechaCalendario = trim(Carbon::parse($calendario->end)->toDateString());
              $calendar->horaIni = trim(Carbon::parse($calendario->start)->toTimeString());
              $calendar->horaFin = trim(Carbon::parse($calendario->end)->toTimeString());
              $calendar->detalle_cronograma()->associate($detallecronograma);
              $calendar->save();
          }
        }

        return response()->json(compact('cronograma'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'duracion' => 'required|string',
            'version' => 'required|integer',
            'fecha' => 'required|date',
            'programa_academico_id' => 'required|integer',
        ]);

        $cronograma = Cronograma::find($id);

        $cronograma->duracion = trim($request->duracion);
        $cronograma->version = trim($request->version);
        $cronograma->fecha = trim($request->fecha);
        $cronograma->programa_academico()->associate($request->programa_academico_id);
        $cronograma->save();

        return response()->json(compact('cronograma'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cronograma::destroy($id);

        return response()->json('success');
    }

    public function ambiente()
    {
        $ambiente = Ambiente::where('valido', '=', 1)->get();

        return response()->json(compact('ambiente'));
    }

    public function docente()
    {
        $docente = Persona::all();

        return response()->json(compact('docente'));
    }

    public function programodulo($id)
    {
        $progrmamodulo = Modulo::where('programa_academico_id', '=', $id)->get();

        return response()->json(compact('progrmamodulo'));
    }

    public function programacademico($id)
    {
       $programacademico = Programa_academico::find($id);

       return response()->json([
         'duracion_pa' => $programacademico->duracion_pa,
       ]);
    }
}
