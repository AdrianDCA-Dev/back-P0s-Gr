<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cronograma extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['version', 'fecha', 'programa_academico_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function programa_academico()
    {
        return $this->belongsTo(Programa_academico::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function detalle_cronograma()
    {
        return $this->belongsToMany(Detalle_cronograma::class);
    }
}
