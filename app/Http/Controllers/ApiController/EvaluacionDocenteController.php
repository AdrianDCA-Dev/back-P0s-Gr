<?php

namespace App\Http\Controllers\ApiController;

use App\Inscripcion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EvaluacionDocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $docente = Inscripcion::where('persona_id', '=', $id)->get();
        $docente->each(function ($docente){
            $docente->detalle_cronograma->persona;
            $docente->detalle_cronograma->cronograma->programa_academico;
            $docente->detalle_cronograma->modulo;
        });

        return response()->json(compact('docente'));
    }
    public function evaluacionCriterioDocente()
    {
        $criterioDocente = DB::select('SELECT criterio_evaluacions.id as criterio_id, criterio_evaluacions.nombre as criterio_nombre, detalle_cronogramas.id as detalle_cronograma_id 
                                                FROM detalle_cronogramas
                                                INNER JOIN criterio_evaluacions
                                                ON detalle_cronogramas.id = criterio_evaluacions.detalle_cronograma_id
                                                WHERE criterio_evaluacions.tipo_evaluacion = 0
                                                AND criterio_evaluacions.valido = 1');

        //$criterioEstudiante = CriterioEvaluacion::where('detalle_cronograma_id', '=', $id)->get();

        return response()->json(compact('criterioDocente'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
