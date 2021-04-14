<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Documentot;
use DB;

class Titulare extends Model
{
    public $fillable = ['nom_tit','id_doc_tit','doc_tit','tel_tit','email_tit','id_user_mod'];
    public static function queryall(){
    	$data = DB::select('SELECT t.id,t.nom_tit,t.id_doc_tit,t.doc_tit,t.tel_tit,t.email_tit,t.id_user_mod,d.documento, concat(d.documento,"-",t.doc_tit) doct from titulares t JOIN documentot d on t.id_doc_tit = d.id order By t.nom_tit ');
        return $data;
    }
    public static function QueryId($id){
    	$data = DB::select ('SELECT t.id,t.nom_tit,t.id_doc_tit,t.doc_tit,t.tel_tit,t.email_tit,t.id_user_mod,d.documento, concat(d.documento,"-",t.doc_tit) doct from titulares t JOIN documentot d on d.id = t.id_doc_tit where t.id =?',[$id]);
    	return $data;
    }
}
