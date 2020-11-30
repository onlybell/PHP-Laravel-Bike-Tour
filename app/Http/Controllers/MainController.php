<?php

namespace App\Http\Controllers;

use App\TourProduct;
use App\TourBlog;
use App\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notification;

class MainController extends Controller
{
    /** 
     * History:
     *      Create - 16/03/2020, Jongil 
     * Description: 
     *      Controller of main page
     * Function:
     *      index() - Main page 
     */

    /** 
     * History:
     *      Create - 16/03/2020, Jongil
     * Description:
     *      Display main page.
     * Parameter: 
     *        
     * Return : 
     *      \Illuminate\Http\Response
     */
    public function index()
    {
        // 6 random travel packages
        $tourProduct = TourProduct::select()
                     ->inRandomOrder()
                     ->limit(6)
                     ->get();

        // Last 2 Blog Posts        
        $tourBlog = TourBlog::select()
                  ->limit(2)
                  ->orderBy('registerDate', 'desc')
                  ->get();

        return view('home', compact('tourProduct','tourBlog'));
    }

}
