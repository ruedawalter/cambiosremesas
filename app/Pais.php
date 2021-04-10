<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
     protected $table = 'paises';
     public $fillable = ['nom_pais','id_user_mod'];
}
