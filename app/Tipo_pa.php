<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// tipo programa academico
class Tipo_pa extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nombre', 'valido', 'descripcion'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function programa_academico()
    {
        return $this->hasOne(Programa_academico::class);
    }
}
