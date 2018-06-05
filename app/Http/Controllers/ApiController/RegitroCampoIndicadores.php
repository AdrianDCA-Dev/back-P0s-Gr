<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Indicadore;
use App\RegistroCampo;

class RegitroCampoIndicadores extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $registroindicadores = RegistroCampo::all();
     /* $registroindicadores->each(function($registroindicadores){
        $registroindicadores->registro_campo;
      });*/

      return response()->json(compact('registroindicadores'));
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
        $registrocampo = new RegistroCampo();
        $registrocampo->fecha = $request->fecha;
        $registrocampo->tipo = $request->tipo;
        $registrocampo->valido = 1;
        $registrocampo->save();
        
        $indicadores = json_decode(json_encode($request->indicadores));

        foreach ($indicadores as $value) {
            $registroindicadores = new Indicadore();
            $registroindicadores->detalle = $value->detalle;
            $registroindicadores->valor = $value->valor;
            $registroindicadores->valido = 1;
            $registroindicadores->registro_campo()->associate($registrocampo);
            $registroindicadores->save();
            $registroindicadores->registro_campo;
        }
       
        return response()->json(compact('registrocampo'));
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
        $registroindicadores = indicadore();
        $registroindicadores->delete();
        $registroindicadores->registro_campo->delete();
    }
}
