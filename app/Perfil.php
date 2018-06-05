<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nombre', 'valido'];
}
