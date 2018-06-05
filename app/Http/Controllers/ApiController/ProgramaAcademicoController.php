<?php

namespace App\Http\Controllers\ApiController;

use App\Contenido;
use App\Modulo;
use App\Programa_academico;
use App\Tipo_pa;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProgramaAcademicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     /*   $programa = Programa_academico::all();
        $programa->each(function ($programa){
            $programa->tipo_pa;
        });*/
   /*     $modulo = Modulo::all();

        $contenido = Contenido::all();

        $var = [
            'programa' => $programa,
            'modulo' => $modulo,
            'contenido' => $contenido
        ];*/
        //$collection = Collection::make($data);
        //$collection->toJson();
      /*  $var = Collection::make($data);
        $var->all();*/
        /*return response()->json(compact('programa'));*/
        $programa = DB::select('SELECT modulos.programa_academico_id, programa_academicos.tipo_pa_id, programa_academicos.nombre as \'programa\', programa_academicos.modalidad,
                                    tipo_pas.nombre as \'tipo\', SUM(numCredito) as \'credito\'
                                    FROM modulos
                                    INNER JOIN programa_academicos
                                    ON programa_academicos.id = modulos.programa_academico_id
                                    INNER JOIN tipo_pas
                                    ON tipo_pas.id = programa_academicos.tipo_pa_id
                                    WHERE programa_academicos.valido = 1
                                    GROUP BY  modulos.programa_academico_id, programa_academicos.tipo_pa_id, programa_academicos.nombre, programa_academicos.modalidad, tipo_pas.nombre');

        return response()->json(compact('programa'));

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
            'modalidad' => 'required|string',
            'objetivo' => 'required|string',
            'tipo_pa_id' => 'required|integer',
        ]);

        $programa = new Programa_academico();
        $programa->nombre = trim($request->nombre);
        $programa->modalidad = trim($request->modalidad);
        $programa->objetivo = trim($request->objetivo);
        //$programa->duracion_pa = trim($request->duracion_pa);
        $programa->valido = 1;
        $programa->tipo_pa()->associate($request->tipo_pa_id);
        $programa->save();
        $programa->tipo_pa;
/*        $modulo = new Modulo();
        $modulo->nombremodulo = trim($request->nombremodulo);
        $modulo->numCredito = trim($request->numCredito);
        $modulo->valido = true;
        $modulo->programa_academico()->associate($programa);
        $modulo->save();*/
        $moduloscontenidos = json_decode(json_encode($request->modulecontent));
    /*    $contenidos = $request->modulecontent;json_decode(json_encode($request->modulecontent),true);te devolverá los datos en matriz
        $contenidos = $request->modulecontent;json_decode(json_encode($request->modulecontent));te devolverá el objeto de clase estándar
        $contenidos = json_encode($contenidoss);*/
        foreach ($moduloscontenidos as $moduloscontenido) {
            $modulo = new Modulo();
            $modulo->nombremodulo = trim($moduloscontenido->nombremodulo);
            $modulo->numero = trim($moduloscontenido->numero);
            $modulo->numCredito = trim($moduloscontenido->numCredito);
            $modulo->valido = 1;
            $modulo->duracion = trim($request->duracion);
            $modulo->programa_academico()->associate($programa);
            $modulo->save();
            foreach ($moduloscontenido->contenido as $item) {
                $content = new Contenido();
                $content->nomcontenido = trim($item);
                $content->modulo()->associate($modulo);
                $content->save();
            }
        }

     /*   foreach ($contenidos as $contenidod) {
            $content = new Contenido();
            $content->nomcontenido = trim($contenidod);
            $content->modulo()->associate($modulo);
            $content->save();
        }*/
        return response()->json(compact('programa'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        /*$contenido = Contenido::all();
        $contenido->each(function($contenido){
            $contenido->modulo->programa_academico;
        });

        return response()->json(compact('contenido'));*/

          $contenido = DB::select('SELECT * FROM tipo_pas
                                    INNER JOIN programa_academicos
                                    ON tipo_pas.id = programa_academicos.tipo_pa_id
                                    INNER JOIN modulos
                                    ON modulos.programa_academico_id = programa_academicos.id
                                    INNER JOIN contenidos
                                    ON contenidos.modulo_id = modulos.id
                                    WHERE programa_academicos.id = 1');

        return response()->json(compact('contenido'));
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
            'modalidad' => 'required|string',
            'tipo_pa_id' => 'required|integer',
        ]);

        $programa = Programa_academico::find($id);

        $programa->nombre = trim($request->nombre);
        $programa->modalidad = trim($request->modalidad);
        $programa->valido = true;
        $programa->tipo_pa()->associate($request->tipo_pa_id);
        $programa->save();

        return response()->json(compact('programa'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Programa_academico::destroy($id);

        return response()->json('success');
    }

    public function type()
    {
        $type = Tipo_pa::where('valido', '1')->get();

        return response()->json(compact('type'));
    }


    public function program()
    {
        $programacademic = Programa_academico::where('valido', '1')->get();

        return response()->json(compact('programacademic'));
    }

    public function modulo($id)
    {
        $modulo = Modulo::where('programa_academico_id', '=', $id)->get();

        return response()->json(compact('modulo'));
    }

    public function contenido($id)
    {
        $contenido = DB::select('SELECT contenidos.nomcontenido FROM modulos
                                    INNER JOIN contenidos
                                    ON modulos.id = contenidos.modulo_id
                                    INNER JOIN programa_academicos
                                    ON programa_academicos.id = modulos.programa_academico_id
                                    WHERE modulos.programa_academico_id = ?',[$id]);

        return response()->json(compact('contenido'));

     /*   $contenido = DB::table('modulos')->join('contenidos', function ($join){
            $join->on('contenidos.modulo_id', '=', 'modulos.id');
        })
        ->join('programa_academicos', function ($join){
            $join->on('programa_academicos.id', '=', 'modulos.programa_academico_id')
            ->where('modulos.programa_academico_id', '=', [$i]);
        });*/
    }
}
