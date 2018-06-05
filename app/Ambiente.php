<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nombre', 'valido'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalle_cronograma()
    {
        return $this->hasMany(Detalle_cronograma::class);
    }
}
