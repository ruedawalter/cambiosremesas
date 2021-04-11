<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    public  $table = 'paises';
    public $fillable = ['nom_pais','id_user_mod'];
}
