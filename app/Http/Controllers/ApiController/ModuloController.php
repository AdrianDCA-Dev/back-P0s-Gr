<?php

namespace App\Http\Controllers\ApiController;

use App\Contenido;
use App\Modulo;
use App\Programa_academico;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulo = Modulo::all();
        $modulo->each(function ($modulo){
            $modulo->programa_academico;
        });
      /*  $contenido = Contenido::all();
        $data = [
            'modulo' => $modulo,
            'contenido' => $contenido
        ];

        $collection = Collection::make($data);
        $collection->toJson();*/
        $contenido = Contenido::all();

        return response()->json(compact('modulo', 'contenido'));
    }

    public function conten($id)
    {
        $contenido = Contenido::where('modulo_id', '=', $id)->get();

        return response()->json(compact('contenido'));
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
            'numCredito' => 'required|string',
            'programa_academico_id' => 'required|integer',
        ]);

        $modulo = new Modulo();

        $modulo->nombre = trim($request->nombre);
        $modulo->numCredito = trim($request->numCredito);
        $modulo->valido = true;
        $modulo->programa_academico()->associate($request->programa_academico_id);
        $modulo->save();
        $modulo->programa_academico;

        $contenido = new Contenido();
        $contenido->modulo()->associate($modulo);
        $contenido->nomcontenido = trim($request->nomcontenido);
        $contenido->save();


        return response()->json(compact('modulo'));
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
            'nombre' => 'required|string',
            'numCredito' => 'required|string',
            'programa_academico_id' => 'required|integer',
        ]);

        $modulo = Modulo::find($id);

        $modulo->nombre = trim($request->nombre);
        $modulo->numCredito = trim($request->numCredito);
        $modulo->valido = trim($request->valido);
        $modulo->programa_academico()->associate($request->programa_academico_id);
        $modulo->save();

        $contenido = Contenido::where('module_id', '=', $id)->find();
        $contenido->modulo()->associate($modulo);
        $contenido->nomcontenido = trim($request->nomcontenido);
        $contenido->save();

        return response()->json(compact('modulo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Modulo::destroy($id);

        return response()->json('success');
    }

    public function moduleactivo()
    {
        $moduleactive = Modulo::where('valido', '1')->get();

        return response()->json(compact('moduleactive'));
    }
}
