<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programa_academico extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nombre', 'valido', 'modalidad', 'objetivo', 'tipo_pa_id'];

    public function tipo_pa()
    {
        return $this->belongsTo(Tipo_pa::class);
    }

    public function cronograma()
    {
        return $this->hasOne(Cronograma::class);
    }

    public function modulo()
    {
        return $this->hasMany(Modulo::class);
    }
}
