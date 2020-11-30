<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserAccount extends Authenticatable
{
    /** 
     * History:
     *      Create - 18/03/2020, Jongil 
     * Description: 
     *      Model of user information
     */
    
    use Notifiable;

    protected $table = 'UserAccount';
    protected $primaryKey = 'uIdx';

    protected $fillable =  [
        'uIdx', 'uEmail', 'password', 'uFirstName', 'uLastName', 'contactNum', 'adminType', 'joinDate',
    ];

    public $timestamps = false;   
}
