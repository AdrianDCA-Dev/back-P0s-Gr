<?php

namespace App\Http\Controllers\ApiController;

use App\Tipo_pa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipoPaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo = Tipo_pa::all();

        return response()->json(compact('tipo'));
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
            'nombre' => 'required|string|unique:tipo_pas',
        ]);

        $tipo = new Tipo_pa();

        $tipo->nombre = trim($request->nombre);
        $tipo->valido = 1;
        $tipo->descripcion = trim($request->descripcion);
        $tipo->save();

        return response()->json(compact('tipo'));
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
            /*'nombre' => 'required|string|unique:tipo_pas',*/
            'nombre' => 'required|string',
        ]);

        $tipo = Tipo_pa::find($id);

        $tipo->nombre = trim($request->nombre);
        $tipo->valido = trim($request->valido);
        $tipo->descripcion = trim($request->descripcion);
        $tipo->save();

        return response()->json(compact('tipo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tipo_pa::destroy($id);
        
        return response()->json('success');
    }
}
