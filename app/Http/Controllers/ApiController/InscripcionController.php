<?php

namespace App\Http\Controllers\ApiController;

use App\Cronograma;
use App\Detalle_cronograma;
use App\Inscripcion;
use App\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inscripcion = Inscripcion::all();
        $inscripcion->each(function ($inscripcion){
            $inscripcion->detalle_cronograma->cronograma->programa_academico;
            $inscripcion->persona;
            $inscripcion->detalle_cronograma->ambiente;
            $inscripcion->detalle_cronograma->persona;
        });

        return response()->json(compact('inscripcion'));
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
      /*  $this->validate($request,[
            'fecha' => 'required|date',
            'detalle_cronograma_id' => 'required|integer',
            'persona_id' => 'required|integer',
        ]);*/

        $ids = $request->detalle_cronograma_id;
        $detalle = Detalle_cronograma::where('cronograma_id', '=', $ids)->get();

        foreach ($detalle as $detacrono) {
            $inscripcion = new Inscripcion();
            $inscripcion->fecha = trim($request->fecha);
            $inscripcion->valido = 1;
            $inscripcion->detalle_cronograma()->associate($detacrono->id);
            $inscripcion->persona()->associate($request->persona_id);
            $inscripcion->save();
        }
        $inscripcion->detalle_cronograma->cronograma->programa_academico;
        $inscripcion->persona;
        $inscripcion->detalle_cronograma->ambiente;

        return response()->json(compact('inscripcion'));
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
            'detalle_cronograma_id' => 'required|integer',
        ]);

        $inscripcion = Inscripcion::find($id);
        $inscripcion->fecha = trim($request->fecha);
        $inscripcion->valido = true;
        $inscripcion->detalle_cronograma()->associate($request->detalle_cronograma_id);
        $inscripcion->persona()->associate($request->persona_id);
        $inscripcion->save();

        return response()->json(compact('inscripcion'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Inscripcion::destroy($id);

        return response()->json('success');
    }

    public function estudiante()
    {
        $estudiante = Persona::all();

        return response()->json(compact('estudiante'));
    }

    public function detallecronogrma()
    {
        $detallecronogrma = Detalle_cronograma::all();
        $detallecronogrma->each(function ($detallecronogrma){
            $detallecronogrma->cronograma->programa_academico;
            $detallecronogrma->modulo->programa_academico;
            $detallecronogrma->persona;
        });
      /*  $detallecronogrma = Cronograma::all();
        $detallecronogrma->each(function ($detallecronogrma){
            $detallecronogrma->programa_academico;
        });*/
        return response()->json(compact('detallecronogrma'));
    }
}
