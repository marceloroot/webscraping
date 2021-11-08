<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    protected $fillable = ['texto','autor','tag','dataCadastro','user_id'];
    use HasFactory;

    public function usuario(){
        // return $this->hasOne('App\Models\Atividades','i_atividades','id');
         return $this->belongsTo('App\Models\User','user_id');
 
     }
}
