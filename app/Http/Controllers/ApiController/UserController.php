<?php

namespace App\Http\Controllers\ApiController;

use App\Formacion;
use App\Persona;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $user->each(function ($user){
            $user->persona;
            /*$user['role'] = $user
            ->roles()
            ->select(['roles.id', 'roles.name'])
            ->get();*/
            $user->roles;
        });

        return response()->json(compact('user'));
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
//        $this->validate($request,[
//            'dni' => 'required|string|unique:personas',
//            'nombres' => 'required|string',
//            'app' => 'required|string',
//            'apm' => 'required|string',
//            'sexo' => 'required|string',
//            'fechaNac' => 'required|date',
//            'direccion' => 'required|string',
//            'fono' => 'required|integer',
//            'name' => 'required|string|min:4',
//            'email' => 'required|email|unique:users',
//            /*'password' => 'required|min:8|confirmed',*/
//        ]);

        $persona = new Persona();
        $persona->dni = trim($request->dni);
        $resultado = intval(preg_replace('/[^0-9]+/', '-', $persona->dni));
       /* $r = preg_split("/[A-Za-z]+/", $persona->dni);
        print_r($r);*/

        $persona->nombres = trim($request->nombres);
        $persona->app = trim($request->app);
        $persona->apm = trim($request->apm);
        $persona->sexo = trim($request->sexo);
        $persona->fechaNac = trim($request->fechaNac);
        $persona->direccion = trim($request->direccion);
        $persona->fono = trim($request->fono);

        $user = new User();
        $persona->save();

        $formacion = json_decode(json_encode($request->formacion));

        foreach ($formacion as $formaciones) {
            $for = new Formacion();
            $for->titulo = $formaciones->titulo;
            $for->fecEmision = $formaciones->fecEmision;
            $for->persona()->associate($persona);
            $for->save();
        }

        $user->name = trim($resultado);
        $user->email = trim(strtolower($request->email));
        $user->password = bcrypt(trim($resultado));
        $user->estado = true;
        $user->persona()->associate($persona);
        $user->save();
        $user->persona;
        $user->roles()->sync($request->role);
        $user->role;
        return response()->json(compact('user'));
    }

    public function editEstado(Request $request, $id)
    {
        $user = User::find($id);

        $user->estado = $request->estado;

        $user->save();

        return response()->json(compact('user'));
    }
    public function indexDocente()
    {
        $docente =  User::join('role_user', function ($join) {
                $join->on('users.id', '=', 'role_user.user_id')
                    ->where('role_user.role_id', '=', 2);
            })
            ->get();
        $docente->each(function ($docente){
            $docente->persona;
        });
        //$user = User::all();

        return response()->json(compact('docente'));
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
            'nombres' => 'required|string',
            'app' => 'required|string',
            'apm' => 'required|string',
            'sexo' => 'required|string',
            'fechaNac' => 'required|date',
            'direccion' => 'required|string',
            'fono' => 'required|integer',
            'name' => 'required|string|min:4',
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

        $user = User::find($id);
        $persona->save();

        $user->name = trim($request->name);
        $user->email = trim(strtolower($request->email));
        $user->persona()->associate($persona);
        $user->save();
        $user->persona;
        $user->roles()->sync($request->role);
        $user->role;

        return response()->json(compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        return response()->json('success');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse\
     */
    public function role()
    {
        $role = Role::all();

        return response()->json(compact('role'));
    }
}
