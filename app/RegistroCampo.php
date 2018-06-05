<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroCampo extends Model
{
    protected $fillable = ['fecha', 'tipo', 'valido'];
}
