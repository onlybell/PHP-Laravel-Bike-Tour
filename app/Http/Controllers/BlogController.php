<?php

namespace App\Http\Controllers;

use App\TourBlog;
use App\TourBlogComments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /** 
     * History:
     *      Create - 23/03/2020, Jongil 
     * Description: 
     *      Controller of Tour blog
     * Function:
     *      index() - Main list page 
     *      show($bIdx) - Detail blog post
     *      storeComment(Request $request) - Store comment of blog post
     */

    /** 
     * History:
     *      Create - 23/03/2020, Jongil
     * Description:
     *      Display a listing of tour blog post.
     * Parameter: 
     *        
     * Return : 
     *      \Illuminate\Http\Response
     */
    public function index()
    {
        // List of tour blog post
        $tourBlog = TourBlog::select()
                  ->withCount('comments')
                  ->orderBy('registerDate', 'desc')
                  ->paginate(10);
        
        return view('blog.blog', compact('tourBlog'));
    }

    /** 
     * History:
     *      Create - 23/03/2020, Jongil
     * Description:
     *      Display the specified resource.
     * Parameter: 
     *      int $bIdx
     * Return : 
     *      \Illuminate\Http\Response
     */
    public function show($bIdx)
    {
        // Detail of blog post
        $tourBlogDetail = TourBlog::findOrFail($bIdx);
        // Previous record of blog post
        $previous_record = TourBlog::where('bIdx', '<', $bIdx)->orderBy('bIdx','desc')->first();
        // Next record of blog post
        $next_record = TourBlog::where('bIdx', '>', $bIdx)->orderBy('bIdx')->first();

        // List of a comment of blog post
        $tourBlogComment = TourBlogComments::select()
                  ->where('bIdx', '=', $bIdx)
                  ->orderBy('bcIdx','desc')
                  ->get();

        // Count of a comment
        $commentCount = $tourBlogComment->count();

        // Check login authentication
        $loginUser = "";
        if (Auth::check()) {
            $loginUser = Auth::user();
        }

        return view('blog.blogDetail', 
                    [ 'loginUser' => $loginUser,
                      'tourBlogDetail' => $tourBlogDetail, 
                      'previous_record' => $previous_record,
                      'next_record' => $next_record,
                      'tourBlogComment' => $tourBlogComment,
                      'commentCount' => $commentCount ]);
    }

    /** 
     * History:
     *      Create - 24/03/2020, Jongil
     * Description:
     *      store a comment about blog post
     * Parameter: 
     *      Request $request
     * Return : 
     *      JSON
     */
    public function storeComment(Request $request)
    {
        // Validate for request
        $validatedData = $request->validate([
            'bIdx' => ['required'],
            'blogComment' => ['required'],
            'userName' => ['required'],
            'userEmail' => ['required'],
        ]);

        // Store values in model
        $tourBlogComment = new TourBlogComments([
            'bIdx' => $request->get('bIdx'),
            'blogComment' => $request->get('blogComment'),
            'userName' => $request->get('userName'),
            'userEmail' => $request->get('userEmail'),
            'registerDate' => now()
        ]);

        // Save to DB
        $tourBlogComment->save();

        return response()->json(['success'=>'Store Comment']);
    }
}
