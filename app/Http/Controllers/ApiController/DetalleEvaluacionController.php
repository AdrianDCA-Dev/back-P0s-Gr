<?php

namespace App\Http\Controllers\ApiController;

use App\Detalle_avaluacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetalleEvaluacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detalleevaluacion = Detalle_avaluacion::all();
        $detalleevaluacion->each(function ($detalleevaluacion){
            $detalleevaluacion->criterio_evaluacion;
            $detalleevaluacion->inscripcion;
        });

        return response()->json(compact('detalleevaluacion'));
    }

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
        $this->validate($request,[
            'fecha' => 'required|date',
            'valor' => 'required|integer',
        ]);

        $detalleevaluacion = new Detalle_avaluacion();
        $detalleevaluacion->fecha_detalle = trim($request->fecha_detalle);
        $detalleevaluacion->valor = trim($request->valor);
        $detalleevaluacion->detalle_cronograma()->associate($request->detalle_cronograma_id);
        $detalleevaluacion->inscripcion()->associate($request->inscripcion_id);
        $detalleevaluacion->criterio_evaluacion()->associate($request->criterio_evaluacion_id);
        $detalleevaluacion->indicador()->associate($request->indicador_id);
        $detalleevaluacion->save();

        return response()->json(compact('detalleevaluacion'));
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
            'fecha' => 'required|date',
            'valor' => 'required|integer',
            'tipo_evaluacion_id' => 'required|integer',
            'inscripcion_id' => 'required|integer',
        ]);

        $detalleevaluacion = Detalle_avaluacion::find($id);
        $detalleevaluacion->fecha = trim($request->fecha);
        $detalleevaluacion->valor = trim($request->valor);
        $detalleevaluacion->inscripcion()->associate($request->inscripcion_id);
        $detalleevaluacion->criterio_evaluacion()->associate($request->criterio_evaluacion_id);
        $detalleevaluacion->save();

        return response()->json(compact('detalleevaluacion'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Detalle_avaluacion::destroy($id);

        return response()->json('success');
    }
}
