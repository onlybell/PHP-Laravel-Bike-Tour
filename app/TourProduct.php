<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourProduct extends Model
{
    /** 
     * History:
     *      Create - 08/04/2020, Jongil 
     * Description: 
     *      Model of Tour product
     */

    protected $table = 'tourProduct';
    protected $primaryKey = 'pIdx';

    protected $fillable =  [
        'pIdx', 'tourCode', 'tourSubTitle', 'adultPrice', 'childePrice', 'tourcontent', 'imgSrc', 'registerDate'
    ];

    public $timestamps = false;   
}
