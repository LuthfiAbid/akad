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
use Redirect;
use Hash;
use Alert;
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
            $transaction = DB::table('transaction')->count();
            $data = Session::get('admin_name');
            return view('home.index',compact('data','transaction'));
        }
    }
    //---------------------------------LOGIN & LOGOUT----------------------------------//
    public function login()
    {
        print_r(Session::get('login'));
        if(!Session::get('login')){
            return view('login.login');
        }else{
        $data = Session::get('admin_name');
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
                Session::put('admin_name',$data->admin_name);
                Session::put('username',$data->username);
                Session::put('id_admin',$data->id_admin);
                Session::put('login',TRUE);
                echo 1;
            }else{
               echo 0;
            }
        }
        else{
            return redirect('/admin/login')->with('alert','Password atau Username, Salah!');
        }
    }

    public function logout()
    {
        // Auth::logout(); // logout user
        Session::flush();
        Redirect::back();
        return redirect('admin/login')->with('alert','Kamu sudah Logout!');
    }
    //------------------------------- END LOGIN & LOGOUT --------------------------//

    //------------------------------ GOODS STOCK ----------------------------------//
    public function apiStock()
    {
        // $users = User::select(['id', 'name', 'email', 'password', 'created_at', 'updated_at']);
        $dataAdmin = Session::get('id_admin');
        $stock = DB::table('goods')
        ->join('categories','categories.id_category','goods.id_category')
        ->select('goods.*','categories.category_name as cat_name')
        ->where('id_admin',$dataAdmin)
        ->orderBy('id_category','ASC')
        ->get();
        // $category = Category::all();
        // dd($stock);

        return Datatables::of($stock)
        ->addColumn('action', function ($stock){
                return '<table id="tabel-in-opsi">'.
                '<tr>'.
                    '<td>'.
                        '<a href="'. url('admin/stock/edit'.'/'.$stock->id_goods) .'" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit '. $stock->goods_name .'">Edit</a>'.'&nbsp;'.
                        '<a href="'. url('admin/stock/delete'.'/'.$stock->id_goods) .'" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" onclick="return confirm('."'Are you sure want to delete it ?'".')" title="Delete '. $stock->goods_name .'">Delete</a>'.'&nbsp;'.
                    '</td>'.
                '</tr>'.
            '</table>';
            })
            ->editColumn('goods_name', function($stock){
                return '<td>'. ucfirst($stock->goods_name) .'</td> ';
            })
            ->editColumn('stock', function($stock){
                return '<td>'. $stock->stock .'</td> ';
            })
            ->editColumn('price', function($stock){
                return '<td>'.'Rp. ' . number_format($stock->price,0, ',' , '.') .'</td> ';
            })
            ->editColumn('category', function($stock){
                return '<td>'. $stock->cat_name .'</td> ';
            })
            ->editColumn('picture', function($stock){
                $fileShirt = "productImages/shirt";
                $filePants = "productImages/Pants";
                $fileDress = "productImages/dress";
            if($stock->id_category = 1){
                return'<td><img src='.asset($fileShirt).'/'.$stock->picture.' height="50px"></img></td>';
            }else if($stock->id_category = 2){
                return'<td><img src='.asset($filePants).'/'.$stock->picture.' height="50px"></img></td>';
            }else{
                return'<td><img src='.asset($fileDress).'/'.$stock->picture.' height="50px"></img></td>';
            }
            })
                ->addIndexColumn()
                ->rawColumns(['goods_name','stock','price','picture','category','action'])
                ->make(true);
    }
    public function goodsStock()
    {
        $data_admin = Session::get('admin_name');
        $data = DB::table('goods')
        ->join('categories','categories.id_category','goods.id_category')
        ->select('goods.*','categories.category_name as cat_name')
        ->orderBy('id_category','ASC')
        ->get();
        return view('goods/index',compact('data','data_admin'));
    }

    public function goodsStockUpdate(Request $request, $id)
    {
        $this->validate($request,[
            'picture' => 'required|image|mimes:png,jpg'
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
        $goods->id_category = $request->id_category;
        $goods->picture = $extension;
        $goods->save();
        Alert::success('Goods Updated!','Success')->autoclose(2000);
        return redirect('admin/stock');
    }

    public function goodsStockEdit($id)
    {
        $data_admin = Session::get('admin_name');
        $data = DB::table('goods')->where('id_goods',$id)->first();
        return view('goods.edit',compact('data','data_admin'));
    }

    public function goodsStockAdd()
    {
        $data_admin = Session::get('admin_name');
        $category = DB::table('categories')->get();
        return view('goods.insert',compact('data_admin','category'));
    }

    public function goodsStockAddPost(Request $request)
    {
        $this->validate($request,[
            'picture' => 'required|image|mimes:png,jpg,jpeg'
            ]);
        $goods = Goods::firstOrNew(['id_goods' => $request->id_goods]);
        $file = $request->file('picture');
        $extension = $file->getClientOriginalName();
        $data_admin = Session::get('id_admin');

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
        $goods->description = $request->description;
        $goods->id_admin = $data_admin;
        $goods->id_category = $request->id_category;
        $goods->picture = $extension;
        $goods->save();        
        Alert::success('Goods Added!','Add')->autoclose(2000);
        return redirect('admin/stock');
    }
    public function pendingstock()
    {
        $data_admin = Session::get('admin_name');
        $data = DB::table('transaction')->where('status','in approve')->get();
        return view('dashboard.pendingstock',compact('data','data_admin'));
    }
    public function goodsDelete($id)
    {
        $data = Goods::findOrFail($id);
        $data->delete();
        return redirect('admin/stock')->with('delete','Delete Succes!');
    }
    //---------------------------------Data User --------------------------------//
    public function dataUser()
    {
        $data_admin = Session::get('admin_name');
        $data = DB::table('buyer')->get();
        return view('user.index',compact('data','data_admin'));
    }
    public function dataUserEdit(Request $request, $id)
    {
        $data = DB::table('buyer')->where('id_buyer',$id)->first();
        $data_admin = Session::get('admin_name');
        return view('user.edit',compact('data','data_admin'));
    }
    public function editDataUserstockst(Request $request)
    {
        $data = Buyer::where('id_buyer',$request->id_buyer)->first();
        $data->id_buyer = $request->id_buyer;
        $data->buyer_name = $request->buyer_name;
        $data->address = $request->address;
        $data->city = $request->city;
        $data->save();
        return redirect('admin/dataUser')->with('alert','Data has been edit!');
    }
    public function apiUser()
    {
        $user = Buyer::orderBy('id_buyer','DESC')->get();
        // dd($stock);
        return Datatables::of($user)
        ->addColumn('action', function ($user){
                return '<table id="tabel-in-opsi">'.
                '<tr>'.
                    '<td>'.
                        '<a href="'. url('admin/dataUser/edit'.'/'.$user->id_buyer) .'" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit '. $user->buyer_name .'">Edit</a>'.'&nbsp;'.
                    '</td>'.
                '</tr>'.
            '</table>';
            })
            ->editColumn('buyer_name', function($user){
                return '<td>'. ($user->buyer_name) .'</td> ';
            })
            ->editColumn('address', function($user){
                return '<td>'. $user->address .'</td> ';
            })
            ->editColumn('city', function($user){
                return '<td>'.$user->city.'</td> ';
            })
                ->addIndexColumn()
                ->rawColumns(['buyer_name','address','city','action'])
                ->make(true);
    }
    // public function userDelete($id)
    // {
    //     $data = Goods::findOrFail($id);
    //     $data->delete();
    //     return redirect('admin/stock')->with('delete','Delete Succes!');
    // }
    //------------------------------------------------------------------------------------------------------//
}
