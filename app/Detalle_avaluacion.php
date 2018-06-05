<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_avaluacion extends Model
{
    /***
     * @var array
     */
    protected $fillable = ['fecha_detalle', 'valor', 'detalle_cronograma_id', 'criterio_evaluacion_id', 'inscripcion_id', 'indicador_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function detalle_cronograma()
    {
        return$this->belongsTo(Detalle_cronograma::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function criterio_evaluacion()
    {
        return $this->belongsTo(CriterioEvaluacion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function indicador()
    {
        return $this->belongsTo(Indicadore::class);
    }
}
