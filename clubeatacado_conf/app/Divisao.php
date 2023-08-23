<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    protected $table = 'TB_DIVISAO';

    protected $fillable=[
        'DS_DIVISAO',
        'ID_SECAO'
    ];

}
