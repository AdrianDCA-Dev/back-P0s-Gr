<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['fechaCalendario', 'horaIni', 'horaFin', 'detalle_cronograma_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function detalle_cronograma()
    {
        return $this->belongsTo(Detalle_cronograma::class);
    }
}
