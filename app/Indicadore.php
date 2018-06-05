<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicadore extends Model
{
    protected $fillable = ['detalle', 'valor', 'valido', 'registro_campo_id'];

    public function registro_campo()
    {
      return $this->belongsTo(RegistroCampo::class);
    }
}
