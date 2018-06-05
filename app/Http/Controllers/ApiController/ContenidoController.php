<?php

namespace App\Http\Controllers\ApiController;

use App\Contenido;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContenidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contenido = Contenido::all();
        $contenido->each(function ($contenido){
            $contenido->modulo;
        });
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
            'modulo_id' => 'required|integer',
        ]);

        $contenido = new Contenido();

        $contenido->nombre = trim($request->nombre);
        $contenido->modulo()->associate($request->modulo_id);
        $contenido->save();
        $contenido->modulo;

        return response()->json(compact('contenido'));
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
            'modulo_id' => 'required|integer',
        ]);

        $contenido = Contenido::find($id);

        $contenido->nombre = trim($request->nombre);
        $contenido->modulo()->associate($request->modulo_id);
        $contenido->save();

        return response()->json(compact('contenido'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contenido::destroy($id);

        return response()->json('success');
    }
}
