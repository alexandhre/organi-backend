<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Pagination extends Model
{
    protected $table = 'TB_PAGINATION';

    protected $fillable = [
        'ID_PAGINATION',
        'VL_DATA',
        'NUMBER_PAGES'
    ];

    public static function getNumberPages()
    {
        $numberPages = DB::table('TB_PAGINATION')->get();
        return $numberPages;
    }    
}
