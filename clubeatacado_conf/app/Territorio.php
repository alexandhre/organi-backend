<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    protected $table = 'TB_TERRITORIO';

    protected $fillable=[
        'ID_TERRITORIO',
        'DS_TERRITORIO'
    ];

}
