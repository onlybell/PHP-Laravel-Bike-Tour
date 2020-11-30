<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingService extends Model
{
    /** 
     * History:
     *      Create - 13/04/2020, Jongil 
     * Description: 
     *      Model of Booking information
     */
    protected $table = 'BookingService';
    protected $primaryKey = 'bIdx';

    protected $fillable =  [
        'bIdx', 
        'bookingCode', 
        'uIdx', 
        'pIdx', 
        'tourCode', 
        'countAdult', 
        'countChild', 
        'tourDate', 
        'userRequirement', 
        'totalPrice', 
        'bookingState', 
        'registerDate', 
        'modifyDate', 
        'cancelDate'
    ];

    public $timestamps = false;   
}
