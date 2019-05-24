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

        return view('login.login');
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
                return redirect('/admin/home');
            }
            else{
                return redirect('/admin/login')->with('alert','Password atau Username, Salah !');
            }
        }
        else{
            return redirect('/admin/login')->with('alert','Password atau Username, Salah!');
        }
    }
    
    public function logout()
    {
        Auth::logout(); // logout user
        Session::flush();
        Redirect::back();
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
    public function goodsStockEdit($id)
    {
        $data_admin = Session::get('nama_admin');
        $data = DB::table('goods')->where('id_goods',$id)->first();
        // dd($data);
        return view('goods.edit',compact('data','data_admin'));
    }

    public function goodsStockAdd()
    {
        $data_admin = Session::get('nama_admin');
        return view('goods.insert',compact('data_admin'));
    }

    public function goodsStockUpdate(Request $request, $id)
    {
        $this->validate($request,[
            'picture' => 'required|image|mimes:jpeg,png,jpg'
            ]);
        $goods = Goods::firstOrNew(['id_goods' => $request->id_goods]);       
        $file = $request->file('picture');
        $extension = $file->getClientOriginalName();

        if($goods->id_category == 1){
        $file->move('productImages/shirt',$extension);
        }else if($goods->id_category == 2){
        $file->move('productImages/pants',$extension);
        }else{
        $file->move('productImages/dress',$extension);
        }
        $goods->goods_name = $request->goods_name;
        $goods->stock = $request->stock;
        $goods->price = $request->price;
        $goods->picture = $extension;
        $goods->save();
        
        return redirect('admin/stock');
    }

    public function goodsStockAddPost(Request $request)
    {        
        $this->validate($request,[
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'id_category' => 'required|numeric'
            ]);

        $admin = Session::get('id_admin');
        // $photo = $request->file('picture');
        // $photoName = $photo->getClientOriginalName();        
        // if($request->id_category == '1'){
        //     $file->move('productImages/shirt',$photoName);
        // }else if($request->id_category == '2'){
        //     $file->move('productImages/pants',$photoName);
        // }else{
        //     $file->move('productImages/dress',$photoName);
        // }        
        $goods = new Goods();
        $goods->id_category = $request->id_category;
        $goods->goods_name = $request->goods_name;
        $goods->stock = $request->stock;
        $goods->id_admin = $admin; 
        $goods->price = $request->price;
        $goods->id_category = $request->id_category;
        // $goods->picture = $photoName;
        $goods->description = $request->description;
        $goods->save();    
        // $save = $photo->move($file,$photoName);
        return redirect('admin/stock');
    }    

    //--------------------------- END GOODS STOCK ----------------------------------//
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
