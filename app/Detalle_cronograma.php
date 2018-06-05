<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_cronograma extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['fechaIni', 'grupo', 'vigente', 'modulo_id', 'cronograma_id', 'ambiente_id', 'persona_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function calendario()
    {
        return $this->hasMany(Calendario::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cronograma()
    {
        return $this->belongsTo(Cronograma::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ambiente()
    {
        return $this->belongsTo(Ambiente::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inscripcion()
    {
        return $this->hasMany(Inscripcion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
