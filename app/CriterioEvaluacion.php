<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CriterioEvaluacion extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['fecha', 'nombre', 'porcentaje', 'tipo_evaluacion', 'valido', 'detalle_cronograma_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function detalle_cronograma()
    {
        return $this->belongsTo(Detalle_cronograma::class);
    }
}
