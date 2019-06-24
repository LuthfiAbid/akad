<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Transaction;
use App\DetailTransaction;
use App\Category;
use Hash;
use DB;

class TrCategoryController extends Controller
{
    //
    public function index()
    {

        if(!Session::get('login_buyer')){
            return view('buyer.content.categories');
        }else{
            $data = DB::table('goods')
            ->join('categories','categories.id_category','goods.id_category')
            ->select('goods.*','categories.*')
            ->get();
$detail_transaction = DB::table('transaction')
            ->join('detail_transaction','transaction.id_transaction','detail_transaction.id_transaction')
            ->join('goods','detail_transaction.id_goods','goods.id_goods')
            ->join('categories','categories.id_category','goods.id_category')
            ->select('goods.*','detail_transaction.*','transaction.*','categories.category_name as cat_name')
            ->where('id_buyer',"=", Session::get('id_buyer'))
            ->where('isdone', "=", "0")
            ->get();
return view('buyer.content.categories', compact('detail_transaction'));
        }
    }


}
