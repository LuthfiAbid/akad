<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\TransactionAkad;
use App\Category;
use App\Admin;
use App\Buyer;
use App\Goods;
use Redirect;
use Session;
use Alert;
use Input;
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
    }
    public function index()
    {
        print_r(Session::get('login'));
        if(!Session::get('login')){
            Alert::error('You must login first!','Warning')->autoclose(2000);
            return redirect('/admin/login')->with('alert','Kamu harus login dulu');
        }else{
            $poPending = DB::table('transaction')->where('isdone','=','1')->where('status','=','pending')->count();
            $payementPending = DB::table('transaction')->where('status','=','in approve')->count();
            $data = Session::get('admin_name');
            return view('home.index',compact('data','poPending','payementPending'));
        }
    }
    //---------------------------------LOGIN & LOGOUT----------------------------------//

    //---------------------------------View Dashboard----------------------------------//
    public function apiPendingPo()
    {
        $pending = DB::table('transaction')
        ->join('buyer','buyer.id_buyer','transaction.id_buyer')
        ->where('transaction.status','=','pending')
        ->where('transaction.isdone','=','1')
        ->select('transaction.*','buyer.buyer_name')
        // ->groupBy('buyer.id_buyer')
        ->get();
        // dd($pending);
        return Datatables::of($pending)
        ->addColumn('action', function ($pending){
                return '<table id="tabel-in-opsi">'.
                '<tr>'.
                    '<td>'.
                        '<a href="'. url('admin/transaction/show'.'/'.$pending->id_transaction) .'" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Show details '. $pending->id_transaction .' ">Show </a>'.'&nbsp;'.
                    '</td>'.
                '</tr>'.
            '</table>';
            })
            ->editColumn('no', function($pending){
                return '<td>'. ($pending->id_transaction).'</td> ';
            })
            ->editColumn('buyer_name', function($pending){
                return '<td>'. ($pending->buyer_name).'</td> ';
            })
            ->editColumn('status', function($pending){
                return '<td>'. ucfirst($pending->status).'</td> ';
            })
            ->editColumn('transaction', function($pending){
                return '<td>'.date('d F Y - H:i:s',strtotime($pending->created_at)).'</td> ';
            })
                ->addIndexColumn()
                ->rawColumns(['no','buyer_name','status','transaction','action'])
                ->make(true);
    }
    public function pendingPo()
    {
        $data_admin = Session::get('admin_name');
        $data = DB::table('transaction')
        ->join('buyer','buyer.id_buyer','transaction.id_buyer')
        ->where('status','=','pending')
        ->get();
        return view('dashboard.pendingPo',compact('data','data_admin'));
    }
    public function updatePendingPoStatus($id)
    {
        $admin = Session::get('id_admin');
        $data = Transaction::find($id)
        ->update(['status' => 'in approve',
        'id_admin' => $admin]);
        return redirect('admin/pendingPO');
    }
    //---------------------------------------------------------------------------------//
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
        ->leftjoin('categories','goods.id_category','categories.id_category')
        ->select('goods.*','categories.category_name as cat_name')
        ->orderBy('id_category','DESC')
        ->get();
        // dd($stock);

        return Datatables::of($stock)
        ->addColumn('action', function ($stock){
                return '<table id="tabel-in-opsi">'.
                '<tr>'.
                    '<td>'.
                        '<a href="'. url('admin/stock/show'.'/'.$stock->id_goods) .'" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Edit '. $stock->goods_name .'">Show</a>'.'&nbsp;'.
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
            if($stock->id_category == 1){
                return'<td><img src='.asset("productImages/Shirt").'/'.$stock->picture.' height="50px"></img></td>';
            }else if($stock->id_category == 2){
                return'<td><img src='.asset("productImages/Pants").'/'.$stock->picture.' height="50px"></img></td>';
            }else{
                return'<td><img src='.asset("productImages/Dress").'/'.$stock->picture.' height="50px"></img></td>';
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
            'picture' => 'required|image|mimes:png,jpg,jpeg'
            ]);
        $goods = Goods::where('id_goods',$id)->first();
        $file = $request->file('picture');
        $extension = $file->getClientOriginalName();
        $dataAdmin = Session::get('id_admin');

        if($goods->id_category == 1){
        $file->move('productImages/Shirt',$extension);
        }else if($goods->id_category == 2){
        $file->move('productImages/Pants',$extension);
        }else{
        $file->move('productImages/Dress',$extension);
        }
        $goods->id_admin = $dataAdmin;
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
        $categories = DB::table('categories')->get();
        $data = DB::table('goods')->where('id_goods',$id)->first();
        return view('goods.edit',compact('data','data_admin','categories'));
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
        $goods = new Goods;
        $file = $request->file('picture');
        $extension = $file->getClientOriginalName();
        $data_admin = Session::get('id_admin');

        if(!(Goods::where('goods_name', '=', $request->goods_name)->exists())){
        if($goods->id_category == 1){
        $file->move('productImages/Shirt',$extension);
        }else if($goods->id_category == 2){
        $file->move('productImages/Pants',$extension);
        }else{
        $file->move('productImages/Dress',$extension);
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
        }else{
        Alert::error('Goods name already exist!','Exist')->autoclose(2000);
        return redirect('admin/stock/add');
        }
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
    public function goodsShow($id)
    {
        $admin = Session::get('admin_name');
        $data = DB::table('goods')
        ->join('categories','categories.id_category','goods.id_category')
        ->where('id_goods',$id)
        ->first();
        return view('goods.show',compact('data','admin'));
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
    public function editDataUserPost(Request $request)
    {
        $data = Buyer::where('id_buyer',$request->id_buyer)->first();
        $data->id_buyer = $request->id_buyer;
        $data->buyer_name = $request->buyer_name;
        $data->address = $request->address;
        $data->city = $request->city;
        $data->save();
        Alert::success('Goods Edited!','Edit')->autoclose(2000);
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
    //------------------------------------------------------------------------------------------------------//

    //-----------------------------------------Transaction--------------------------------------------------//
        public function transactionIndex()
        {
            $dataAdmin = Session::get('id_admin');
            $data = DB::table('transaction')->get();
            return view('transaction.index',compact('data','dataAdmin'));
        }
        public function showTransaction($id)
        {
            $sumQty = DB::table('detail_transaction')
            ->join('transaction','transaction.id_transaction','detail_transaction.id_transaction')
            ->where('transaction.isdone','=','1')
            ->where('detail_transaction.id_transaction',$id)
            ->sum('detail_transaction.qty');

            $sumPrice =  DB::table('detail_transaction')
            ->join('transaction','transaction.id_transaction','detail_transaction.id_transaction')
            ->where('transaction.isdone','=','1')
            ->where('detail_transaction.id_transaction',$id)
            ->sum('detail_transaction.subtotal');

            $data = DB::table('transaction')
            ->join('buyer','buyer.id_buyer','transaction.id_buyer')
            ->join('detail_transaction','detail_transaction.id_transaction','transaction.id_transaction')
            ->join('goods','goods.id_goods','detail_transaction.id_goods')
            ->where('detail_transaction.id_transaction',$id)
            ->get();
            return view('transaction.show',compact('sumQty','sumPrice','data','totalPlusTax'));
        }
        public function apiTransaction()
        {
        $dataAdmin = Session::get('id_admin');
        $stock = DB::table('transaction')
        ->join('buyer','buyer.id_buyer','transaction.id_buyer')
        ->where('status','pending')
        ->get();
        return Datatables::of($stock)
        ->addColumn('action', function ($stock){
                return '<table id="tabel-in-opsi">'.
                '<tr>'.
                    '<td>'.
                        '<a href="'. url('admin/transaction/show'.'/'.$stock->id_transaction) .'" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top">Show</a>'.'&nbsp;'.
                        '<a href="'. url('admin/transaction/cancel'.'/'.$stock->id_transaction) .'" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" onclick="return confirm('."'Are you sure want to cancel it ?'".')">Cancel</a>'.'&nbsp;'.
                    '</td>'.
                '</tr>'.
            '</table>';
            })
            ->editColumn('buyer_name', function($stock){
                return '<td>'. ucfirst($stock->buyer_name) .'</td> ';
            })
            ->editColumn('status', function($stock){
                return '<td>'. ucfirst($stock->status) .'</td> ';
            })
            ->editColumn('created_at', function($stock){
                return '<td>'. date('d M y H:i',strtotime($stock->created_at)) .'</td> ';
            })        
                ->addIndexColumn()
                ->rawColumns(['buyer_name','status','created_at','action'])
                ->make(true);
    }
    public function inApprove($id)
    {
        $admin = Session::get('id_admin');
        $data = Transaction::find($id)
        ->update(['status' => 'in approve',
                  'id_admin' => $admin]);
        return redirect('admin/dataTransaction');
    }
    //------------------------------------------------------------------------------------------------------//

    //-------------------------------------Payment Verification---------------------------------------------//
    public function paymentVerification()
    {    
        $dataAdmin = Session::get('admin_name');
        $data = DB::table('transaction')->get();
        return view('payment.index',compact('data','dataAdmin'));
    }
    public function apiPaymentVerification()
    {
        $dataAdmin = Session::get('admin_name');
        $payment = DB::table('transaction')
        ->join('buyer','buyer.id_buyer','transaction.id_buyer')
        ->where('status','in approve')
        ->get();
        return Datatables::of($payment)
        ->addColumn('action', function ($payment){
                return '<table id="tabel-in-opsi">'.
                '<tr>'.
                    '<td>'.
                        '<a href="'. url('admin/paymentVerification/agree'.'/'.$payment->id_transaction) .'" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top">Aggre an Payment</a>'.'&nbsp;'.
                    '</td>'.
                '</tr>'.
            '</table>';
            })
            ->editColumn('id_transaction', function($payment){
                return '<td>'. ucfirst($payment->id_transaction) .'</td> ';
            })
            ->editColumn('buyer_name', function($payment){
                return '<td>'. ucfirst($payment->buyer_name) .'</td> ';
            })
            ->editColumn('status', function($payment){
                return '<td>'. $payment->status .'</td> ';
            })        
                ->addIndexColumn()
                ->rawColumns(['id_transaction','buyer_name','status','action'])
                ->make(true);
        }

        public function updatePayment($id)
        {
            $data = DB::table('transaction')
            ->where('id_transaction',$id)
            ->update([
                'status' => 'agree'
            ]);
            return redirect('admin/dataPaymentVerification');
        }
    //------------------------------------------------History Payment---------------------------------------//
        public function historyPayment()
        {
            $data = DB::table('transaction')
            ->get();
            $dataAdmin = Session::get('admin_name');
            return view('history.index',compact('data','dataAdmin'));
        }

        public function apiHistoryPayment()
        {
            $dataAdmin = Session::get('admin_name');
            $payment = DB::table('transaction')
            ->join('buyer','buyer.id_buyer','transaction.id_buyer')
            ->select('transaction.*','buyer.buyer_name')
            ->where('status','agree')
            ->get();
            return Datatables::of($payment)
            ->addColumn('action', function ($payment){
                return '<table id="tabel-in-opsi">'.
                '<tr>'.
                    '<td>'.
                        '<a href="'. url('admin/history/show'.'/'.$payment->id_transaction) .'" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top">Show History</a>'.'&nbsp;'.
                    '</td>'.
                '</tr>'.
            '</table>';
            })
            ->editColumn('id_transaction', function($payment){
                return '<td>'. ucfirst($payment->id_transaction) .'</td> ';
            })
            ->editColumn('buyer_name', function($payment){
                return '<td>'. ucfirst($payment->buyer_name) .'</td> ';
            })
            ->editColumn('created_at', function($payment){
                return '<td>'. date('d F Y H:s.s', strtotime($payment->created_at)) .'</td> ';
            }) 
            ->editColumn('status', function($payment){
                return '<td>'. ucfirst($payment->status) .'</td> ';
            })        
                ->addIndexColumn()
                ->rawColumns(['id_transaction','buyer_name','status','action','created_at'])
                ->make(true);
        }

        public function showHistory($id)
        {
            $buyer = DB::table('transaction')
            ->join('buyer','buyer.id_buyer','transaction.id_buyer')
            ->where('id_transaction',$id)
            ->first();

            $data = DB::table('transaction')
            ->join('buyer','buyer.id_buyer','transaction.id_buyer')
            ->join('detail_transaction','detail_transaction.id_transaction','transaction.id_transaction')
            ->join('goods','goods.id_goods','detail_transaction.id_goods')
            ->where('transaction.id_transaction',$id)
            ->get();
            
            $sumPrice =  DB::table('detail_transaction')
            ->join('transaction','transaction.id_transaction','detail_transaction.id_transaction')
            ->where('transaction.isdone','=','1')
            ->where('detail_transaction.id_transaction',$id)
            ->sum('detail_transaction.subtotal');

            $desc = DB::table('transaction')
            ->join('buyer','buyer.id_buyer','transaction.id_buyer')
            ->join('detail_transaction','detail_transaction.id_transaction','transaction.id_transaction')
            ->join('goods','goods.id_goods','detail_transaction.id_goods')
            ->where('transaction.id_transaction',$id)
            ->select('transaction.description')
            ->first();
            // dd($desc);
            
            $admin = Session::get('admin_name');
            return view('history.show',compact('data','admin','buyer','desc','sumPrice'));
        }
    //------------------------------------------------------------------------------------------------------//
    }
    //------------------------------------------------------------------------------------------------------//
