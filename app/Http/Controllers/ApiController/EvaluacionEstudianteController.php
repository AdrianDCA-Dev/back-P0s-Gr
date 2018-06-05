<?php

namespace App\Http\Controllers\ApiController;

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
        $programacademic = DB::select('SELECT * FROM modulos
                                            INNER JOIN programa_academicos
                                            ON programa_academicos.id = modulos.programa_academico_id
                                            INNER JOIN detalle_cronogramas
                                            ON detalle_cronogramas.modulo_id = modulos.id
                                            INNER JOIN personas
                                            ON personas.id = detalle_cronogramas.persona_id
                                            WHERE personas.id = ?',[$id]);

        return response()->json(compact('programacademic'));
    }

    public function moduleEval($idp, $idpa)
    {
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
