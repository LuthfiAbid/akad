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
        $goods['all'] = DB::table('goods')
            ->join('categories','categories.id_category','goods.id_category')
            ->select('goods.*','categories.*')
            ->paginate(6);
        $detail_transaction = DB::table('transaction')
            ->join('detail_transaction','transaction.id_transaction','detail_transaction.id_transaction')
            ->join('goods','detail_transaction.id_goods','goods.id_goods')
            ->join('categories','categories.id_category','goods.id_category')
            ->select('goods.*','detail_transaction.*','transaction.*','categories.category_name as cat_name')
            ->where('id_buyer',"=", Session::get('id_buyer'))
            ->where('isdone', "=", "0")
            ->get();
        $count_data_goods = DB::table('goods')
            ->count();
        $goods_w_ts = DB::table('goods')
            ->join('categories','categories.id_category','goods.id_category')
            ->select('goods.*','categories.category_name as cat_name')
            ->orderBy('id_goods','DESC')
            ->limit(3)
            ->get();
        return view('buyer.content.categories',$goods, compact('detail_transaction','count_data_goods','goods_w_ts'));
        }else{
        $goods['all'] = DB::table('goods')
            ->join('categories','categories.id_category','goods.id_category')
            ->select('goods.*','categories.*')
            ->paginate(6);
        $detail_transaction = DB::table('transaction')
            ->join('detail_transaction','transaction.id_transaction','detail_transaction.id_transaction')
            ->join('goods','detail_transaction.id_goods','goods.id_goods')
            ->join('categories','categories.id_category','goods.id_category')
            ->select('goods.*','detail_transaction.*','transaction.*','categories.category_name as cat_name')
            ->where('id_buyer',"=", Session::get('id_buyer'))
            ->where('isdone', "=", "0")
            ->get();
        $get_count = DB::table('goods')
            ->count();
        $goods_w_ts = DB::table('goods')
            ->join('categories','categories.id_category','goods.id_category')
            ->select('goods.*','categories.category_name as cat_name')
            ->orderBy('id_goods','DESC')
            ->limit(3)
            ->get();
            return view('buyer.content.categories',$goods, compact('detail_transaction','count_data_goods','goods_w_ts'));
        }
    }


}
