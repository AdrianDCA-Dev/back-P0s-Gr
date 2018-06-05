<?php

namespace App\Http\Controllers\ApiController;

use App\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persona = Persona::all();

        return response()->json(compact('persona'));
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
            'dni' => 'required|string|unique:personas',
            'nombres' => 'required|string',
            'app' => 'required|string',
            'apm' => 'required|string',
            'sexo' => 'required|string',
            'fechaNac' => 'required|date',
            'direccion' => 'required|string',
            'fono' => 'required|integer',
        ]);

        $persona = new Persona();

        $persona->dni = trim($request->dni);
        $persona->nombres = trim($request->nombres);
        $persona->app = trim($request->app);
        $persona->apm = trim($request->apm);
        $persona->sexo = trim($request->sexo);
        $persona->fechaNac = trim($request->fechaNac);
        $persona->direccion = trim($request->direccion);
        $persona->fono = trim($request->fono);
        $persona->save();

        return response()->json(compact('persona'));
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
            'dni' => 'required|string',
            'nombres' => 'required|string',
            'app' => 'required|string',
            'apm' => 'required|string',
            'sexo' => 'required|string',
            'fechaNac' => 'required|date',
            'direccion' => 'required|string',
            'fono' => 'required|integer',
        ]);

        $persona = Persona::find($id);

        $persona->dni = trim($request->dni);
        $persona->nombres = trim($request->nombres);
        $persona->app = trim($request->app);
        $persona->apm = trim($request->apm);
        $persona->sexo = trim($request->sexo);
        $persona->fechaNac = trim($request->fechaNac);
        $persona->direccion = trim($request->direccion);
        $persona->fono = trim($request->fono);
        $persona->save();

        return response()->json(compact('persona'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Persona::destroy($id);

        return response()->json('success');
    }
}
