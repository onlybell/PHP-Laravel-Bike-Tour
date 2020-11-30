<?php

namespace App\Http\Controllers;

use App\TourProduct;
use App\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Log;
use Illuminate\Support\Str;

class TourController extends Controller
{
    /** 
     * History:
     *      Create - 08/04/2020, Jongil 
     * Description: 
     *      Controller of Tour product
     * Function:
     *      index() - Tour Product List page 
     */

    /** 
     * History:
     *      Create - 08/04/2020, Jongil
     * Description:
     *      Display a listing of tour product.
     * Parameter: 
     *        
     * Return : 
     *      \Illuminate\Http\Response
     */
    public function index()
    {
        // List of tour product
        $tourProduct = TourProduct::select()
                     ->orderBy('registerDate', 'desc')
                     ->paginate(12);
        
        return view('tour.tour', compact('tourProduct'));
    }

    /** 
     * History:
     *      Create - 08/04/2020, Jongil
     * Description:
     *      Display the specified resource.
     * Parameter: 
     *      int $pIdx
     * Return : 
     *      \Illuminate\Http\Response
     */
    public function show($pIdx)
    {
        // Detail of tour product
        $tourProduct = TourProduct::findOrFail($pIdx);
        $today = now()->format('d/m/Y');

        return view('tour.tourDetail', 
                    ['tourProduct' => $tourProduct,
                     'today' => $today]);
    }

    /** 
     * History:
     *      Create - 13/04/2020, Jongil
     * Description:
     *      Confirm to Booking information
     * Parameter: 
     *      Request $request
     * Return : 
     *      \Illuminate\Http\Response
     */
    public function tourBook(Request $request)
    {        
        // Detail of tour product
        $tourProduct = TourProduct::findOrFail($request->get('pIdx'));

        $adultCount = $request->get('adultCount');
        $adultPrice = $tourProduct->adultPrice;
        $childCount = $request->get('childCount');
        $childPrice = $tourProduct->childPrice;
        $totalPrice = ($adultCount * $adultPrice) + ($childCount * $childPrice);
        return view('tour.tourBook', 
                    ['bookInfo' => $request, 'tourProduct' => $tourProduct, 'totalPrice' => $totalPrice]);
    }

       /** 
     * History:
     *      Create - 13/04/2020, Jongil
     * Description:
     *      Save to Booking information
     * Parameter: 
     *      Request $request
     * Return : 
     *      \Illuminate\Http\Response
     */
    public function tourBookConfirm(Request $request)
    {     
        // Validate for request
        $validatedData = $request->validate([
            'pIdx' => ['required'],
            'tourCode' => ['required'],
            'countAdult' => ['required'],
            'countChild' => ['required'],
            'tourDate' => ['required'],
            'totalPrice' => ['required']
        ]);
        
        // Random code for Bookin code
        $bookingCode = 'B'.Str::random(9);
                
        $tourDate = Carbon::createFromFormat('d/m/Y', $request->get('tourDate'))->format('Y-m-d'); 

        // Store values in model
        $bookingService = new BookingService([
            'bookingCode' => $bookingCode,
            'uIdx' => Auth::user()->uIdx,
            'pIdx' => $request->get('pIdx'),
            'tourCode' => $request->get('tourCode'),
            'countAdult' => $request->get('countAdult'),
            'countChild' => $request->get('countChild'),
            'tourDate' => $tourDate,
            'userRequirement' => $request->get('userRequirement'),
            'totalPrice' => $request->get('totalPrice'),
            'registerDate' => now()
        ]);

        // Save to DB
        $bookingService->save();

        return response()->json(['success'=>$bookingCode]);
    }

    /** 
     * History:
     *      Create - 07/04/2020, Jongil
     * Description:
     *      Display Booking information
     * Parameter: 
     *      String $bookingCode  
     * Return : 
     *      \Illuminate\Http\Response
     */
    public function tourBookThanks($bookingCode)
    {
        $bookingService = BookingService::select('BookingService.*','TourProduct.adultPrice','TourProduct.childPrice','TourProduct.tourTitle')
                  ->join('TourProduct','BookingService.tourCode','=','TourProduct.tourCode')
                  ->join('UserAccount','BookingService.uIdx','=','UserAccount.uIdx')
                  ->where('bookingCode', '=', $bookingCode)
                  ->first();

        return view('tour.tourBookThanks',
                    ['bookingService' => $bookingService]);
    }
}
