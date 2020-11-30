<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BikeNews extends Model
{
    /** 
     * History:
     *      Create - 23/04/2020, Jongil 
     * Description: 
     *      Model of News for Mobile App (COMP709 Class at Wintec)
     */
    protected $table = 'BikeNews';
    protected $primaryKey = 'nIdx';

    protected $fillable =  [
        'nIdx', 'newsTitle', 'newsContent', 'registerDate'
    ];

    public $timestamps = false;   
}
