<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\UserAccount;
use App\UserContact;
use App\BookingService;

class AdminController extends Controller
{
    /** 
     * History:
     *      Create - 29/04/2020, Jongil
     * Description:
     *      Display Booking List
     * Parameter: 
     *      
     * Return : 
     *      \Illuminate\Http\Response
     */
    public function manageBooking()
    {
        $bookingService = BookingService::select('BookingService.*','UserAccount.uFirstName','UserAccount.uLastName','TourProduct.adultPrice','TourProduct.childPrice','TourProduct.tourTitle')
                  ->join('TourProduct','BookingService.tourCode','=','TourProduct.tourCode')
                  ->join('UserAccount','BookingService.uIdx','=','UserAccount.uIdx')
                  ->orderBy('tourDate', 'desc')
                  ->paginate(10);

        return view('admin.manageBooking', ['bookingService' => $bookingService]);
    }

    /** 
     * History:
     *      Create - 29/04/2020, Jongil
     * Description:
     *      Display Booking information
     * Parameter: 
     *      String $bookingCode  
     * Return : 
     *      \Illuminate\Http\Response
     */
    public function manageBookingDetail($bookingCode)
    {
        $bookingService = BookingService::select('BookingService.*','UserAccount.uEmail','UserAccount.uFirstName','UserAccount.uLastName','UserAccount.ContactNum','TourProduct.adultPrice','TourProduct.childPrice','TourProduct.tourTitle')
                  ->join('TourProduct','BookingService.tourCode','=','TourProduct.tourCode')
                  ->join('UserAccount','BookingService.uIdx','=','UserAccount.uIdx')
                  ->where('bookingCode', '=', $bookingCode)
                  ->first();

        return view('admin.manageBookingDetail',
                    ['bookingService' => $bookingService]);
    }

    /** 
     * History:
     *      Create - 29/04/2020, Jongil
     * Description:
     *      Booking Cancel
     * Parameter: 
     *      String $bookingCode  
     * Return : 
     *      \Illuminate\Http\Response
     */
    public function manageBookingCancel(Request $request)
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
     *      Create - 29/04/2020, Jongil
     * Description:
     *      Booking Process
     * Parameter: 
     *      String $bookingCode  
     * Return : 
     *      \Illuminate\Http\Response
     */
    public function manageBookingProcess(Request $request)
    {
        $bookingService = BookingService::select()
                  ->where('bookingCode', '=', $request->get('bookingCode'))
                  ->first();

        $bookingService->bookingState = 'P';

        // Update to DB
        $bookingService->save();

        return response()->json(['success'=>'Booking Process']);
    }

    /** 
     * History:
     *      Create - 29/04/2020, Jongil
     * Description:
     *      Booking Confirm
     * Parameter: 
     *      String $bookingCode  
     * Return : 
     *      \Illuminate\Http\Response
     */
    public function manageBookingConfirm(Request $request)
    {
        $bookingService = BookingService::select()
        ->where('bookingCode', '=', $request->get('bookingCode'))
        ->first();

        $bookingService->bookingState = 'A';

        // Update to DB
        $bookingService->save();
        
        return response()->json(['success'=>'Booking Confirm']);
    }

        /** 
     * History:
     *      Create - 29/04/2020, Jongil
     * Description:
     *      Booking Confirm
     * Parameter: 
     *      String $bookingCode  
     * Return : 
     *      \Illuminate\Http\Response
     */
    public function manageBookingHold(Request $request)
    {
        BookingService::where('bookingCode', '=', $request->get('bookingCode'))
        ->update(['bookingState' => 'H']);

        return response()->json(['success'=>'Booking Confirm']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manageTourPackages()
    {
        //
    }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manageContactUs()
    {
        //
    }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manageMembers()
    {
        //
    }
    
}
