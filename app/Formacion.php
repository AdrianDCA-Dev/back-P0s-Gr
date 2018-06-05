<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formacion extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['titulo', 'fecEmision', 'persona_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
