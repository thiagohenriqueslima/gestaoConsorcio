<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consorcio extends Model
{
    protected $fillable = [
    	'descricao',
    	'num_participantes',
    	'vigencia_ini',
    	'vigencia_fim',
    	'ativo'
    ];
}
