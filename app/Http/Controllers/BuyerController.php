<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Buyer;
use Hash;
use DB;

class BuyerController extends Controller
{
    //
    public function index()
    {
        // print_r(Session::get('username'));
        if(!Session::get('login_buyer')){
            return view('buyer.home');
        }else{
        $data = Session::get('buyer_name');
            return view('buyer.home',compact('data'));
        }
    }
    
    public function login()
    {
        // print_r(Session::get('username'));
        if(!Session::get('login_buyer')){
             return view('buyer.login');
        }else{
            $data = Session::get('buyer_name');
        return view('buyer.home',compact('data'));
        }
    }

    public function register()
    {
        // print_r(Session::get('username'));
        // if(!Session::get('login_buyer')){
             return view('buyer.register');
        // }else{
        //     $data = Session::get('buyer_name');
        // return view('buyer.home',compact('data'));
        // }
    }

    public function loginPostBuyer(Request $request)
    {
        try {
            $username = $request->username;
            $password = $request->password;

        $data = Buyer::where('username',$username)->first();
        if($data){ //apakah email tersebut ada atau tidak
            if(Hash::check($password,$data->password)){
                Session::put('buyer_name',$data->buyer_name);
                Session::put('username',$data->username);
                Session::put('id_buyer',$data->id_buyer);
                Session::put('login_buyer',TRUE);
                // return redirect('buyer/home');
                echo 1;
            }
            else{
                echo 0;
            }
        }
        else{
            return redirect('/buyer/login')->with('alert','Password atau Username, Salah!');
        }
          } catch (Exception $e) {
                  return $e;
          }
        
    }

    public function saveRegisterBuyer(Request $request){
        $buyer = new Buyer();
        if ($buyer) {
        $buyer->username = $request->username;
        $buyer->password = bcrypt($request->password);
        $buyer->buyer_name = $request->buyer_name;
        $buyer->address = $request->address;
        $buyer->city = $request->city;
        $buyer->save();
           echo 1;
        }else{
            echo 0;
        }

    }

    public function logout()
    {
        Session::flush();
        return redirect('buyer/home')->with('alert','Kamu sudah Logout!');
    }

    public function setting(Request $request, $id_buyer)
    {
        $data_buyer = DB::table('buyer')->where('id_buyer',$id_buyer)->first();
        $data = Session::get('buyer_name');
        return view('buyer.setting',compact('data_buyer','data'));
    }
    public function updateSettingBuyer(Request $request)
    {
        $buyer = Buyer::firstOrNew(['id_buyer' => $request->id_buyer]);
        $buyer->username = $request->username;
        if ($request->password != "no") {
            $buyer->password = bcrypt($request->password);
        }
        $buyer->buyer_name = $request->buyer_name;
        $buyer->address = $request->address;
        $buyer->city = $request->city;
        $buyer->save();
            if ($buyer) {
            Session::put('username', $request->username);
            Session::put('buyer_name', $request->buyer_name);
                echo 1;
            } else {
                echo 0;
            }
        // return redirect('buyer/dataUser')->with('alert','Data has been edit!');
    }
}
