<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    private $jwtAuth;
    public function __construct(JWTAuth $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }
    private function getRolesAbilities()
    {
        $abilities = [];
        $roles = Role::all();

        foreach ($roles as $role) {
            if (!empty($role->name)) {
                $abilities[$role->name] = [];
                $rolePermission = $role->perms()->get();

                foreach ($rolePermission as $permission) {
                    if (!empty($permission->name)) {
                        array_push($abilities[$role->name], $permission->name);
                    }
                }
            }
        }

        return $abilities;
    }
    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');
        $roleId = $request->roleid;
        if (!$token = $this->jwtAuth->attempt($credentials)) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
        $user = $this->jwtAuth->authenticate($token);
        $user->persona;
        $abilities = $this->getRolesAbilities();
        $userRole = [];

        foreach ($user->roles as $role) {
            //$userRole [] = $role->name;
            if ($role->id == $roleId){
                $userRole [] = $role->name;
            }
        }
        if ($userRole == [] ) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
        return response()->json(compact('token','user', 'userRole', 'abilities'));
    }
    public function refresh()
    {
        $token = $this->jwtAuth->getToken();
        $token = $this->jwtAuth->refresh($token);
        return response()->json(compact('token'));
    }
    public function logout()
    {
        $token = $this->jwtAuth->getToken();
        $this->jwtAuth->invalidate($token);
        return response()->json(['logout']);
    }
    public function me()
    {
        if (!$user = $this->jwtAuth->parseToken()->authenticate()) {
            return response()->json(['error' => 'user_not_found'], 404);
        }
        return response()->json(compact('user'));
    }
}
