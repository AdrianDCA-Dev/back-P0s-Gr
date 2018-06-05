<?php

namespace App\Http\Controllers\ApiController;

use App\CriterioEvaluacion;
use App\Detalle_avaluacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CriterioEvaluacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $criterio = CriterioEvaluacion::all();
        $criterio->each(function ($criterio) {
            $criterio->detalle_cronograma;
            $criterio->detalle_cronograma->cronograma->programa_academico;
            $criterio->detalle_cronograma->modulo->programa_academico;
            $criterio->persona;
            $criterio->detalle_cronograma->ambiente;
            $criterio->detalle_cronograma->persona;
        });
        return response()->json(compact('criterio'));
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
        $this->validate($request,[
            'nombre' => 'required|string',
            'porcentaje' => 'required|string',
            'detalle_cronograma_id' => 'required|integer',
        ]);

     /*   $cri = $request->crite;
        $deta = $request->deta;

        foreach ($deta as $datas)
        {*/
            $criterio = new CriterioEvaluacion();
            $criterio->fecha = Carbon::now()->toDateTimeString();
            $criterio->nombre = trim($request->nombre);
            $criterio->porcentaje = trim($request->porcentaje);
            $criterio->tipo_evaluacion = trim($request->tipo_evaluacion);
            $criterio->valido = 1;
            $criterio->detalle_cronograma()->associate($request->detalle_cronograma_id);
            $criterio->save();
            $criterio->detalle_cronograma;
            $criterio->detalle_cronograma->cronograma->programa_academico;
            $criterio->persona;
            $criterio->detalle_cronograma->ambiente;
            $criterio->detalle_cronograma->persona;
        /*    foreach ($datas->detalle as $item) {
                $detalleevaluacion = new Detalle_avaluacion();
                $detalleevaluacion->fecha_detalle = $request->fecha_detalle;
                $detalleevaluacion->valor = $request->valor;
                $detalleevaluacion->inscripcion()->associate($request->inscripcion_id);
                $detalleevaluacion->criterio_evaluacion()->associate($criterio);
                $detalleevaluacion->save();
            }
        }*/

        return response()->json(compact('criterio'));
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
            'nombre' => 'required|string',
            'porcentaje' => 'required|string',
            'tipo_evaluacion' => 'required|string',
            'detalle_cronograma_id' => 'required|integer',
        ]);

        $criterio = CriterioEvaluacion::find();
        $criterio->fecha = trim($request->fecha);
        $criterio->nombre = trim($request->nombre);
        $criterio->porcentaje = trim($request->porcentaje);
        $criterio->tipo_evaluacion = trim($request->tipo_evaluacion);
        $criterio->valido = true;
        $criterio->detalle_cronograma()->associate($request->detalle_cronograma_id);
        $criterio->save();

        return response()->json(compact('criterio'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CriterioEvaluacion::destroy($id);

        return response()->json('success');
    }
}
