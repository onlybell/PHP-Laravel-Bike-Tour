<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserContact extends Model
{
    /** 
     * History:
     *      Create - 06/04/2020, Jongil 
     * Description: 
     *      Model of Contact us
     */

    protected $table = 'UserContact';
    protected $primaryKey = 'cIdx';

    protected $fillable =  [
        'cIdx', 'cTitle', 'cMessage', 'cName', 'cEmail', 'cContactNum', 'registerDate', 'checkContact', 'checkDate',
    ];

    public $timestamps = false;   
}
