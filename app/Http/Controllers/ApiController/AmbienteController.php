<?php

namespace App\Http\Controllers\ApiController;

use App\Ambiente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AmbienteController extends Controller
{
    public function index()
    {
        $ambiente=Ambiente::all();


        //  Solo se utiliza para mostrar la lista de las relaciones de las tablas
        //  $ambiente->each(function ($ambiente){
        //  $ambiente->gestion;
        //  $ambiente->user;
        //});

        return response()->json(compact('ambiente'));

    }
    public function show($id)
    {

        $ambiente=Ambiente::find($id);
        //Se uttiliza para mostrar las relaciones de la tabla

       // $ambiente['user']=$ambiente
         //   ->user()
           // ->get();
        //$ambiente['gestion']=$ambiente
           // ->gestion()
            //->get();
        return response()->json(compact('ambiente'));

    }
    //

    public function update(Request $request, $id)
    {
        $ambiente=Ambiente::find($id);

        //Se utiliza cuando la tabla tiene relaciones

        //$ambiente->user->associate($request->user_id);
        //$ambiente->gestion->associate($request->gestion_id);

        $ambiente->fecha=trim($request->fecha);
        $ambiente->nombre=trim($request->nombre);
        $ambiente->valido=trim($request->valido);
        $ambiente->save();

        return response()->json(compact('ambiente'));

    }

    public function store(Request $request)
    {
        //Se utiliza cuando la tabla tiene relaciones

        //$ambiente->user->associate($request->user_id);
        //$ambiente->gestion->associate($request->gestion_id);

        $ambiente=new Ambiente();
        $ambiente->fecha=trim($request->fecha);
        $ambiente->nombre=trim($request->nombre);
        $ambiente->valido=trim($request->valido);
        $ambiente->save();
        return response()->json(compact('ambiente'));

    }

    public function destroy($id)
    {
        Ambiente::destroy($id);
        return response()->json('success');
    }
}
