<?php

namespace App\Http\Controllers\ApiController;

use App\CriterioEvaluacion;
use App\Detalle_cronograma;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Programa_academico;
use Illuminate\Support\Facades\DB;
use App\Inscripcion;
class EvaluacionEstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    public function programModule($id)
    {
        $programacademic = DB::select('SELECT DISTINCT programa_academicos.id, programa_academicos.nombre FROM detalle_cronogramas
                                                INNER JOIN cronogramas
                                                ON  detalle_cronogramas.cronograma_id =  cronogramas.id
                                                INNER JOIN programa_academicos
                                                ON programa_academicos.id = cronogramas.programa_academico_id
                                                WHERE detalle_cronogramas.persona_id = ?',[$id]);

        return response()->json(compact('programacademic'));
    }

    public function moduleEval($idp, $idpa)
    {

      /*  $prueba1 = Detalle_cronograma::where('persona_id', '=', $idp)->first();*/


        $moduleval = DB::select('SELECT * FROM detalle_cronogramas
                                        INNER JOIN modulos
                                        ON detalle_cronogramas.modulo_id = modulos.id
                                        INNER JOIN programa_academicos
                                        ON programa_academicos.id = modulos.programa_academico_id
                                        INNER JOIN personas
                                        ON personas.id = detalle_cronogramas.persona_id
                                        INNER JOIN ambientes
                                        ON ambientes.id = detalle_cronogramas.ambiente_id
                                        WHERE detalle_cronogramas.persona_id = ?
                                        AND modulos.programa_academico_id = ?',[$idp, $idpa]);

        return response()->json(compact('moduleval'));
        
    }

    public function evaluacionCriterio($idp, $idm)
    {
        $criterioEstudiante = DB::select('SELECT criterio_evaluacions.id, criterio_evaluacions.nombre
                                                FROM detalle_cronogramas
                                                INNER JOIN criterio_evaluacions
                                                ON detalle_cronogramas.id = criterio_evaluacions.detalle_cronograma_id
                                                WHERE detalle_cronogramas.persona_id = ?
                                                AND detalle_cronogramas.modulo_id = ?',[$idp, $idm]);

        //$criterioEstudiante = CriterioEvaluacion::where('detalle_cronograma_id', '=', $id)->get();

        return response()->json(compact('criterioEstudiante'));
    }

    public function detallestudiante($id)
    {
        $inscripcion = Inscripcion::where('detalle_cronograma_id', '=', $id)->first();
        $inscripcion->each(function ($inscripcion){
            $inscripcion->persona;
        });

        return response()->json(compact('inscripcion'));
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
