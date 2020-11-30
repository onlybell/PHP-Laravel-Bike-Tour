<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourBlogComments extends Model
{
    /** 
     * History:
     *      Create - 24/03/2020, Jongil
     * Description:
     *      Model of Blog post comment
     */

    protected $table = 'tourBlogComments';
    protected $primaryKey = 'bcIdx';

    protected $fillable =  [
        'bcIdx', 'bIdx', 'blogComment', 'userName', 'userEmail', 'registerDate', 'modifyDate'
    ];

    public $timestamps = false;   
    
    // 
    public function post()
    {
        return $this->belongsTo(TourBlog::class);
    }
}
