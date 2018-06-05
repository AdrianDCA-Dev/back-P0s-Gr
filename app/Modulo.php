<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nombremodulo', 'numero', 'numCredito', 'valido', 'duracion', 'programa_academico_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function programa_academico()
    {
        return $this->belongsTo(Programa_academico::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contenido()
    {
        return $this->hasMany(Contenido::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalle_cronograma()
    {
        return $this->hasMany(Detalle_cronograma::class);
    }
}
