<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Titulare extends Model
{
    public $fillable = ['nom_tit','id_doc_tit','doc_tit','tel_tit','email_tit','id_user_mod'];
}
