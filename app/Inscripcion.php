<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['fecha', 'valido', 'persona_id' ,'detalle_cronograma_id'];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function detalle_cronograma()
    {
        return $this->belongsTo(Detalle_cronograma::class);
    }
}
