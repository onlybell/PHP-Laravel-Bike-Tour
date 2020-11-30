<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourBlog extends Model
{
    /** 
     * History:
     *      Create - 08/04/2020, Jongil 
     * Description: 
     *      Model of Tour product
     */
    protected $table = 'tourBlog';
    protected $primaryKey = 'bIdx';

    protected $fillable =  [
        'bIdx', 'uIdx', 'blogTitle', 'blogContent', 'imgSrc', 'registerDate', 'modifyDate'
    ];

    public $timestamps = false;   

    // 
    public function comments()
    {
        return $this->hasMany(TourBlogComments::class, 'bIdx');
    }
}
