<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Admin;
use App\Buyer;
use App\Goods;
use App\Category;
use Session;
use Hash;
use DB;

class AdminController extends Controller
{
    use AuthenticatesUsers;
 
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/home';
    public function __construct()
    {
        $this->redirectTo = 'admin/login';
        // $this->middleware('guest', ['except' => 'logout']);
    }
    public function index()
    {
        print_r(Session::get('login'));
        if(!Session::get('login')){
            return redirect('/admin/login')->with('alert','Kamu harus login dulu');
        }else{
            $data = Session::get('nama_admin');
            return view('home.index',compact('data'));
        }
    }
    //---------------------------------LOGIN & LOGOUT----------------------------------//
    public function login()
    {
        print_r(Session::get('login'));
        if(!Session::get('login')){
            return view('login.login');
        }else{
        $data = Session::get('nama_admin');
        return view('home.index',compact('data'));
        }
    }

    public function loginPost(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $data = Admin::where('username',$username)->first();
        if($data){ //apakah email tersebut ada atau tidak
            if(Hash::check($password,$data->password)){
                Session::put('nama_admin',$data->admin_name);
                Session::put('username',$data->username);
                Session::put('id_admin',$data->id_admin);
                Session::put('login',TRUE);
                // return redirect('/admin/home');
                echo 1;
            }
            else{
                echo 0;
            }
        }
        else{
            return redirect('/admin/home')->with('alert','Password atau Username, Salah!');
        }
    }
    
    public function logout()
    {
        Session::flush();
        return redirect('admin/login')->with('alert','Kamu sudah Logout!');
    }
    //------------------------------- END LOGIN & LOGOUT --------------------------//

    //------------------------------ GOODS STOCK ----------------------------------//
    public function goodsStock()
    {
        $data_admin = Session::get('nama_admin');
        $data = DB::table('goods')
        ->join('categories','categories.id_category','goods.id_category')
        ->select('goods.*','categories.category_name as cat_name')
        ->get();
        return view('goods/index',compact('data','data_admin'));
    }
    public function dataUser()
    {
        $data_admin = Session::get('nama_admin');
        $data = DB::table('buyer')->get();
        return view('user.index',compact('data','data_admin'));
    }
    public function dataUserEdit(Request $request, $id)
    {
        $data = DB::table('buyer')->where('id_buyer',$id)->first();
        $data_admin = Session::get('nama_admin');
        return view('user.edit',compact('data','data_admin'));
    }
    public function editDataUserPost(Request $request)
    {
        $data = Buyer::where('id_buyer',$request->id_buyer)->first();
        $data->id_buyer = $request->id_buyer;
        $data->buyer_name = $request->buyer_name;
        $data->address = $request->address;
        $data->city = $request->city;
        $data->save();
        return redirect('admin/dataUser')->with('alert','Data has been edit!');
    }
}
