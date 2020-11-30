<?php

namespace App\Http\Controllers;

use App\UserAccount;
use App\UserContact;
use App\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\BikeTourMail;

class UserController extends Controller
{
    /** 
     * History:
     *      Create - 18/03/2020, Jongil 
     * Description: 
     *      Controller of user information
     * Function:
     *      index() - Main page 
     */

    /** 
     * History:
     *      Create - 06/04/2020, Jongil
     * Description:
     *      Display Contact us page
     * Parameter: 
     *        
     * Return : 
     *      \Illuminate\Http\Response
     */
    public function contact()
    {
        // Check login authentication
        $loginUser = "";
        if (Auth::check()) {
            $loginUser = Auth::user();
        }

        return view('contact.contact', ['loginUser' => $loginUser]);
    }

    /** 
     * History:
     *      Create - 07/04/2020, Jongil
     * Description:
     *      Store a newly created contact data in storage.
     * Parameter: 
     *      Request  $request
     * Return : 
     *      JSON
     */
    public function storeContact(Request $request)
    {
        // Validate for request
        $validatedData = $request->validate([
            'cTitle' => ['required', 'max:250'],
            'cMessage' => ['required'],
            'cName' => ['required'],
            'cEmail' => ['required'],
        ]);

        // Store values in model
        $UserContact = new UserContact([
            'cTitle' => $request->get('cTitle'),
            'cMessage' => $request->get('cMessage'),
            'cName' => $request->get('cName'),
            'cEmail' => $request->get('cEmail'),
            'cContactNum' => $request->get('cContactNum'),
            'registerDate' => now()
        ]);

        // Save to DB
        $UserContact->save();

        $data['title'] = $request->get('cTitle');
        $data['content'] = $request->get('cMessage');
        $data['name'] = $request->get('cName');
        $data['email'] = $request->get('cEmail');
        $data['contactnum'] = $request->get('cContactNum');

        Mail::to($request->get('cEmail'), $request->get('cName'))
           ->send(new BikeTourMail('Contact Us - '.$request->get('cTitle'), $data));

        return response()->json(['success'=>'Store Contact Information']);
    }

    /** 
     * History:
     *      Create - 07/04/2020, Jongil
     * Description:
     *      Display Contact confirm page
     * Parameter: 
     *        
     * Return : 
     *      \Illuminate\Http\Response
     */
    public function contactConfirm()
    {
        return view('contact.contactConfirm');
    }

    /** 
     * History:
     *      Create - 13/04/2020, Jongil
     * Description:
     *      Display profile and contact data
     * Parameter: 
     *        
     * Return : 
     *      \Illuminate\Http\Response
     */
    public function profile()
    {
        $loginUser = Auth::user();
        
        return view('mypage.profile', ['loginUser' => $loginUser]);
    }

    /** 
     * History:
     *      Create - 13/04/2020, Jongil
     * Description:
     *      Update profile data
     * Parameter: 
     *      Request $request  
     * Return : 
     *      JSON
     */
    public function updateProfile(Request $request, UserAccount $userAccount)
    {
        $userInfo = UserAccount::find($request->get('uIdx'));

        if ($request->get('password') != '') {
            // Validate for request
            $validatedData = $request->validate([
                'password' => ['required'],
            ]);
 
            $userInfo->password = Hash::make($request->get('password'));
        }

        $validatedData = $request->validate([
            'uEmail' => ['required', 'max:250'],
            'uFirstName' => ['required'],
            'uLastName' => ['required'],
        ]);
   
        $userInfo->uFirstName = $request->get('uFirstName');
        $userInfo->uLastName = $request->get('uLastName');
        $userInfo->contactNum = $request->get('contactNum');
    
        // Update to DB
        $userInfo->save();

        return response()->json(['success'=>'Update Profile']);
    }

    /** 
     * History:
     *      Create - 13/04/2020, Jongil
     * Description:
     *      Display Contact confirm page
     * Parameter: 
     *        
     * Return : 
     *      \Illuminate\Http\Response
     */
    public function myBooking()
    {
        $loginUser = Auth::user();

        $bookingService = BookingService::select('BookingService.*','TourProduct.adultPrice','TourProduct.childPrice','TourProduct.tourTitle')
                  ->join('TourProduct','BookingService.tourCode','=','TourProduct.tourCode')
                  ->join('UserAccount','BookingService.uIdx','=','UserAccount.uIdx')
                  ->where('BookingService.uIdx', '=', $loginUser->uIdx)
                  ->orderBy('tourDate', 'desc')
                  ->paginate(10);

        return view('mypage.myBooking', ['bookingService' => $bookingService]);
    }

    /** 
     * History:
     *      Create - 14/04/2020, Jongil
     * Description:
     *      Display Booking information
     * Parameter: 
     *      String $bookingCode  
     * Return : 
     *      \Illuminate\Http\Response
     */
    public function myBookingDetail($bookingCode)
    {
        $bookingService = BookingService::select('BookingService.*','TourProduct.adultPrice','TourProduct.childPrice','TourProduct.tourTitle')
                  ->join('TourProduct','BookingService.tourCode','=','TourProduct.tourCode')
                  ->join('UserAccount','BookingService.uIdx','=','UserAccount.uIdx')
                  ->where('bookingCode', '=', $bookingCode)
                  ->first();

        return view('mypage.myBookingDetail',
                    ['bookingService' => $bookingService]);
    }

    /** 
     * History:
     *      Create - 14/04/2020, Jongil
     * Description:
     *      Booking Cancel
     * Parameter: 
     *      String $bookingCode  
     * Return : 
     *      \Illuminate\Http\Response
     */
    public function myBookingCancel(Request $request)
    {
        $bookingService = BookingService::select()
                  ->where('bookingCode', '=', $request->get('bookingCode'))
                  ->first();

        $bookingService->bookingState = 'C';
        $bookingService->cancelDate = now();

        // Update to DB
        $bookingService->save();

        return response()->json(['success'=>'Booking Cancel']);
    }

    /** 
     * History:
     *      Create - 16/04/2020, Jongil
     * Description:
     *      Booking Edit
     * Parameter: 
     *      String $bookingCode  
     * Return : 
     *      \Illuminate\Http\Response
     */
    public function myBookingEdit(Request $request)
    {
        $bookingService = BookingService::select()
                  ->where('bookingCode', '=', $request->get('bookingCode'))
                  ->first();

        $tourDate = Carbon::createFromFormat('d/m/Y', $request->get('tourDate'))->format('Y-m-d'); 
        
        $bookingService->countAdult = $request->get('countAdult');
        $bookingService->countChild = $request->get('countChild');
        $bookingService->tourDate = $tourDate;
        $bookingService->userRequirement = $request->get('userRequirement');
        $bookingService->totalPrice = $request->get('totalPrice');

        // Update to DB
        $bookingService->save();

        return response()->json(['success'=>'Booking Edit']);
    }

}
