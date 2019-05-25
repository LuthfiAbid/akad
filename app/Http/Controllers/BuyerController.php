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
        if(!Session::get('login')){
            return view('buyer.home');
        }else{
        $data = Session::get('buyer_name');
            return view('buyer.home',compact('data'));
        }
    }
    
    public function login()
    {
        // print_r(Session::get('username'));
        if(!Session::get('login')){
             return view('buyer.login');
        }else{
            $data = Session::get('buyer_name');
        return view('buyer.home',compact('data'));
        }
    }

    public function register()
    {
        // print_r(Session::get('username'));
        if(!Session::get('login')){
             return view('buyer.register');
        }else{
            $data = Session::get('buyer_name');
        return view('buyer.home',compact('data'));
        }
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
                Session::put('login',TRUE);
                // return redirect('buyer/home');
                var_dump($data);
            }
            else{
                return redirect('/buyer/login')->with('alert','Password atau Username, Salah !');
            }
        }
        else{
            return redirect('/buyer/login')->with('alert','Password atau Username, Salah!');
        }
          } catch (Exception $e) {
                  return $e;
          }
        
    }

    public function saveRegisterBuyer(){
        $buyer = new Buyer();
        $buyer->username = $request->username;
        $buyer->password = $request->password;
        $buyer->buyer_name = $request->buyer_name;
        $buyer->address = $request->address;
        $buyer->city = $request->city;
        $buyer->save();
        return redirect('/input');

    }

    public function logout()
    {
        Session::flush();
        return redirect('buyer/home')->with('alert','Kamu sudah Logout!');
    }
    public function dataUser()
    {
        $data_admin = Session::get('nama_buyer');
        $data = DB::table('buyer')->get();
        return view('buyer.index',compact('data','data_admin'));
    }
    public function dataUserEdit(Request $request, $id)
    {
        $data = DB::table('buyer')->where('id_buyer',$id)->first();
        $data_admin = Session::get('nama_buyer');
        return view('buyer.edit',compact('data','data_buyer'));
    }
    public function editDataUserPost(Request $request)
    {
        $data = Buyer::where('id_buyer',$request->id_buyer)->first();
        $data->id_buyer = $request->id_buyer;
        $data->buyer_name = $request->buyer_name;
        $data->address = $request->address;
        $data->city = $request->city;
        $data->save();
        return redirect('buyer/dataUser')->with('alert','Data has been edit!');
    }
}
