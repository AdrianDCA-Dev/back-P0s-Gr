<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth/login','AuthController@login');
Route::post('auth/refresh','AuthController@refresh');
Route::get('auth/logout','AuthController@logout');
Route::get('role', 'ApiController\UserController@role');

Route::group(['middleware' => 'jwt.auth', 'namespace' => 'ApiController\\'], function(){
    Route::get('persona', 'PersonaController@index');
    Route::post('persona', 'PersonaController@store');
    Route::put('persona/{id}', 'PersonaController@update');
    Route::delete('persona/{id}', 'PersonaController@destroy');

    Route::get('user', 'UserController@index');
    Route::post('user', 'UserController@store');
    Route::put('user/{id}', 'UserController@update');
    Route::delete('user/{id}', 'UserController@destroy');
    Route::put('abil/{id}', 'UserController@editEstado');

    Route::get('type', 'TipoPaController@index');
    Route::post('type', 'TipoPaController@store');
    Route::put('type/{id}', 'TipoPaController@update');
    Route::delete('type/{id}', 'TipoPaController@destroy');

    Route::get('program', 'ProgramaAcademicoController@index');
    Route::post('program', 'ProgramaAcademicoController@store');
    Route::put('program/{id}', 'ProgramaAcademicoController@update');
    Route::delete('program/{id}', 'ProgramaAcademicoController@destroy');
    Route::get('typeactive', 'ProgramaAcademicoController@type');
    Route::get('programacademic', 'ProgramaAcademicoController@program');

    Route::get('modulo/{id}', 'ProgramaAcademicoController@modulo');
    Route::get('content/{id}', 'ProgramaAcademicoController@contenido');
    Route::get('contentTodo', 'ProgramaAcademicoController@show');

    Route::get('module', 'ModuloController@index');
    Route::post('module', 'ModuloController@store');
    Route::put('module/{id}', 'ModuloController@update');
    Route::delete('module/{id}', 'ModuloController@destroy');
    Route::get('moduleactive', 'ModuloController@moduleactivo');
    Route::get('contenidomodulo/{id}', 'ModuloController@conten');

    Route::get('cronograma', 'CronogramaController@index');
    Route::post('cronograma', 'CronogramaController@store');
    Route::put('cronograma/{id}', 'CronogramaController@update');
    Route::delete('cronograma/{id}', 'CronogramaController@destroy');
    Route::get('ambiente', 'CronogramaController@ambiente');
    Route::get('docente', 'CronogramaController@docente');
    Route::get('programodule/{id}', 'CronogramaController@programodulo');
    Route::get('programacademico/{id}', 'CronogramaController@programacademico');
    Route::get('detmodule/{id}', 'CronogramaController@detModule');


    Route::get('contenido', 'ContenidoController@index');
    Route::post('contenido', 'ContenidoController@store');
    Route::put('contenido/{id}', 'ContenidoController@update');
    Route::delete('contenido/{id}', 'ContenidoController@destroy');

    Route::get('inscripcion', 'InscripcionController@index');
    Route::post('inscripcion', 'InscripcionController@store');
    Route::put('inscripcion/{id}', 'InscripcionController@update');
    Route::delete('inscripcion/{id}', 'InscripcionController@destroy');
    Route::get('estudiante', 'InscripcionController@estudiante');
    Route::get('detallecronograma', 'InscripcionController@detallecronogrma');

    Route::get('criterioevaluacion', 'CriterioEvaluacionController@index');
    Route::post('criterioevaluacion', 'CriterioEvaluacionController@store');
    Route::put('criterioevaluacion/{id}', 'CriterioEvaluacionController@update');
    Route::delete('criterioevaluacion/{id}', 'CriterioEvaluacionController@destroy');

    Route::get('registercamind', 'RegitroCampoIndicadores@index');
    Route::post('registercamind', 'RegitroCampoIndicadores@store');

    Route::get('listindicadores', 'RegitroCampoIndicadores@indicadores');

    Route::get('evalestudiante', 'EvaluacionEstudianteController@index');
    Route::post('evalestudiante', 'EvaluacionEstudianteController@store');
    Route::put('evalestudiante', 'EvaluacionEstudianteController@update');
    Route::delete('evalestudiante', 'EvaluacionEstudianteController@destroy');
    Route::get('evalestudiantepromodule/{id}', 'EvaluacionEstudianteController@programModule');
    Route::get('evalmodulestudiante/{idp}/{idpa}', 'EvaluacionEstudianteController@moduleEval');

    Route::get('evalestudiantecriterio/{idp}/{idm}', 'EvaluacionEstudianteController@evaluacionCriterio');

    Route::get('detalleestudiante/{id}', 'EvaluacionEstudianteController@detallestudiante');
    Route::post('evaluacionestudiante', 'EvaluacionEstudianteController@store');

    Route::get('evaluardocente/{id}', 'EvaluacionDocenteController@index');
    Route::get('evaluaradmindocente', 'EvaluacionAdminDocente@index');
    Route::get('evaldocentecriterio', 'EvaluacionDocenteController@evaluacionCriterioDocente');
    /*  Route::get('detalleevaluacion', 'DetalleEvaluacionController@index');
        Route::post('detalleevaluacion', 'DetalleEvaluacionController@store');
        Route::put('detalleevaluacion/{id}', 'DetalleEvaluacionController@update');
        Route::delete('detalleevaluacion/{id}', 'DetalleEvaluacionController@destroy');*/
});
