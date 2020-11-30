<?php

namespace App\Http\Controllers;

use App\TourProduct;
use App\BikeNews;
use App\TourBlog;
use App\UserAccount;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class JsonController extends Controller
{
    /** 
     * History:
     *      Create - 23/04/2020, Jongil 
     * Description: 
     *      Controller of JSON data for Mobile App, This is for COMP709 Class at Wintec
     * Function:
     *      index() - Main list page 
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($param)
    {
        $data = array(); 
        if ($param == "TourProduct" || $param == "TourProductAll") {
            if ($param == "TourProduct") {
                $results = TourProduct::select('pIdx', 'tourTitle', 'imgSrc')
                        ->inRandomOrder()
                        ->limit(2)
                        ->get();
            }
            else if ($param == "TourProductAll") {
                $results = TourProduct::select('pIdx', 'tourTitle', 'imgSrc')
                        ->orderBy('registerDate', 'desc')
                        ->get();
            }

            foreach($results as $row) {
                if (strlen($row["tourTitle"]) > 15)
                    $tourTitle = substr($row["tourTitle"],0,15)."...";
                else 
                    $tourTitle = $row["tourTitle"];
                
                if ($row["imgSrc"] == null)
                    $imgSrc = "http://192.168.1.64/assets/img/service/default-image.jpg";
                else
                    $imgSrc = "http://192.168.1.64/assets/img/service/".$row["imgSrc"];
                    
                array_push($data, 
                    array(
                        'pIdx'=>$row["pIdx"],
                        'tourTitle'=>$tourTitle,
                        'imgSrc'=>$imgSrc
                    ));
            }
        }
        else if ($param == "News" || $param == "NewsAll") {
            if ($param == "News") {
                $results = BikeNews::select('nIdx', 'newsTitle', 'registerDate')
                    ->orderBy('registerDate', 'desc')
                    ->limit(2)
                    ->get();
            }
            else if ($param == "NewsAll") {
                $results = BikeNews::select('nIdx', 'newsTitle', 'registerDate')
                        ->orderBy('registerDate', 'desc')
                        ->get();
            }

            foreach($results as $row) {
                array_push($data, 
                    array(
                        'nIdx'=>$row['nIdx'],
                        'newsTitle'=>$row['newsTitle'],
                        'registerDate'=>substr($row['registerDate'],0,10)
                    ));
            }
        }
        else if ($param == "Blog" || $param == "BlogAll") {
            if ($param == "Blog") {
                $results = TourBlog::select('bIdx', 'blogTitle', 'imgSrc')
                        ->orderBy('registerDate', 'desc')
                        ->limit(4)
                        ->get();
            }
            else if ($param == "BlogAll") {
                $results = TourBlog::select('bIdx', 'blogTitle', 'imgSrc')
                     ->orderBy('registerDate', 'desc')
                     ->get();
            }

            foreach($results as $row) {

                if ($row["imgSrc"] == null)
                    $imgSrc = "http://192.168.1.64/assets/img/blog/default-image-blog.jpg";
                else
                    $imgSrc = "http://192.168.1.64/assets/img/blog/".$row["imgSrc"];

                array_push($data, 
                    array(
                        'bIdx'=>$row['bIdx'],
                        'blogTitle'=>$row['blogTitle'],
                        'imgSrc'=>$imgSrc
                    ));
            }
        }

        $json = json_encode(array($param=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);

        return $json;
    }

    public function tourDetail($param, $idx)
    {
        $data = array(); 
        if ($param == "TourProduct") {
            $results = TourProduct::findOrFail($idx);
                
            if ($results["imgSrc"] == null)
                $imgSrc = "http://192.168.1.64/assets/img/service/default-image.jpg";
            else
                $imgSrc = "http://192.168.1.64/assets/img/service/".$results["imgSrc"];
                
            array_push($data, 
                array(
                    'pIdx'=>$results["pIdx"],
                    'tourTitle'=>$results["tourTitle"],
                    'imgSrc'=>$imgSrc,
                    'tourSubTitle'=>$results["tourSubTitle"],
                    'tourContent'=>$results["tourContent"]
                ));

        }
        else if ($param == "News") {
            $results = BikeNews::findOrFail($idx);
                
            array_push($data, 
                array(
                    'nIdx'=>$results["nIdx"],
                    'newsTitle'=>$results["newsTitle"],
                    'newsContent'=>$results["newsContent"],
                    'registerDate'=>$results["registerDate"]
                ));
        }
        else if ($param == "Blog") {
            $results = TourBlog::findOrFail($idx);

            if ($results["imgSrc"] == null)
                $imgSrc = "http://192.168.1.64/assets/img/blog/default-image-blog.jpg";
            else
                $imgSrc = "http://192.168.1.64/assets/img/blog/".$results["imgSrc"];
                
            array_push($data, 
                array(
                    'bIdx'=>$results["bIdx"],
                    'blogTitle'=>$results["blogTitle"],
                    'blogContent'=>$results["blogContent"],
                    'registerDate'=>$results["registerDate"],
                    'imgSrc'=>$imgSrc
                ));
        }

        $json = json_encode(array($param=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);

        return $json;
    }

    public function postLogin(Request $request) 
    {
        $data = array(); 

        $email = $request['email'];
        $password = $request['password'];

        $user = UserAccount::where('uEmail', '=', $email)->first();

        if (!$user) {
            array_push($data, 
                array(
                    'result'=>'fail',
                    'message'=>'Login Fail, please check your email',
                    'email'=>'',
                    'firstname'=>'',
                    'lastname'=>'',
                    'contactnumber'=>''
            ));

            return json_encode(array("Login"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
        }

        if (!Hash::check($password, $user->password)) {

            array_push($data, 
                array(
                    'result'=>'fail',
                    'message'=>'Login Fail, please check your password',
                    'email'=>'',
                    'firstname'=>'',
                    'lastname'=>'',
                    'contactnumber'=>''
            ));

            return json_encode(array("Login"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
        }
        
        if ($user['contactNum'] == null) {
            $contactNumber = '';
        }
        else {
            $contactNumber = $user['contactNum'];
        }

        array_push($data, 
                array(
                    'result'=>'success',
                    'message'=>'Login Sucess',
                    'email'=>$user['uEmail'],
                    'firstname'=>$user['uFirstName'],
                    'lastname'=>$user['uLastName'],
                    'contactnumber'=>$contactNumber
            ));

        return json_encode(array("Login"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
    }

    public function postSignup(Request $request) 
    {
        $email = $request['email'];
        $password = $request['password'];
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];

        $data = array(); 

        $user = UserAccount::where('uEmail', '=', $email)->first();

        if ($user) {
            array_push($data, 
                array(
                    'result'=>'fail',
                    'message'=>'Sign Up Fail, please check your email',
                    'email'=>'',
                    'firstname'=>'',
                    'lastname'=>'',
                    'contactnumber'=>''
            ));

            return json_encode(array("Signup"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
        }
        else {
            // Store values in model
            $user = new UserAccount([
                'uEmail' => $email,
                'password' => Hash::make($password),
                'uFirstName' => $firstname,
                'uLastName' => $lastname,
                'joinDate' => now()
            ]);

            // Save to DB
            $user->save();
        }

        array_push($data, 
                array(
                    'result'=>'success',
                    'message'=>'Signup Sucess',
                    'email'=>$email,
                    'firstname'=>$firstname,
                    'lastname'=>$lastname,
                    'contactnumber'=>''
            ));

        return json_encode(array("Signup"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
    }

    public function updateProfile(Request $request) 
    {
        UserAccount::where('uEmail', '=', $request['email'])
        ->update(['uFirstName' => $request['firstname'], 'uLastName' => $request['lastname'], 'contactNum' => $request['contactnumber']]);
        
        $user = UserAccount::where('uEmail', '=', $request['email'])->first();

        $data = array(); 

        if ($user['contactNum'] == null) {
            $contactNumber = '';
        }
        else {
            $contactNumber = $user['contactNum'];
        }

        array_push($data, 
                array(
                    'result'=>'success',
                    'message'=>'Login Sucess',
                    'email'=>$user['uEmail'],
                    'firstname'=>$user['uFirstName'],
                    'lastname'=>$user['uLastName'],
                    'contactnumber'=>$contactNumber
            ));

        return json_encode(array("Profile"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
    }
    
    public function updatePassword($email, $password) 
    {
        UserAccount::where('uEmail', '=', $email)
        ->update(['password' => Hash::make($password)]);

        $data = array(); 

        array_push($data, 
                array(
                    'result'=>'success',
                    'message'=>'Signup Sucess'
            ));

        return json_encode(array("Password"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
        
    }

}
