<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = ['dni', 'nombres', 'app', 'apm', 'sexo', 'fechaNac', 'direccion', 'fono'];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function formacion()
    {
        return $this->hasMany(Formacion::class);
    }
}
