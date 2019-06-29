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
    public function index(Request $request)
    {
        $goods['search'] = $request->search;
        $goods['category_name'] = "";
        if(!Session::get('login_buyer')){
            if ($request->search == "") {
                $goods['all'] = DB::table('goods')
                ->join('categories','categories.id_category','goods.id_category')
                ->select('goods.*','categories.*')
                ->paginate(6);
            } else {
                $goods['all'] = DB::table('goods')
                ->join('categories','categories.id_category','goods.id_category')
                ->select('goods.*','categories.*')
                ->where('goods.goods_name', 'like', '%' . $request->search . '%')
                ->paginate(6);
            }
        $goods['count_goods'] = DB::table('goods')
        ->join('categories','categories.id_category','goods.id_category')
        ->select('goods.*','categories.*')
        ->where('goods.goods_name', 'like', '%' . $request->search . '%')
        ->count();
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
        $category = DB::table('categories')
            ->select('category_name')
            ->get();
        return view('buyer.content.categories',$goods, compact('category','detail_transaction','count_data_goods','goods_w_ts'));
        }else{
            $goods['search'] = $request->search;
            if ($request->search == "") {
                $goods['all'] = DB::table('goods')
                ->join('categories','categories.id_category','goods.id_category')
                ->select('goods.*','categories.*')
                ->paginate(6);
            } else {
                $goods['all'] = DB::table('goods')
                ->join('categories','categories.id_category','goods.id_category')
                ->select('goods.*','categories.*')
                ->where('goods.goods_name', 'like', '%' . $request->search . '%')
                ->paginate(6);

            }
            $goods['count_goods'] = DB::table('goods')
            ->join('categories','categories.id_category','goods.id_category')
            ->select('goods.*','categories.*')
            ->where('goods.goods_name', 'like', '%' . $request->search . '%')
            ->count();
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
            $category = DB::table('categories')
                ->select('category_name')
                ->get();
            return view('buyer.content.categories',$goods, compact('category','detail_transaction','count_data_goods','goods_w_ts'));
        }
    }

    function viewSelectedCategory(Request $request, $category_name){
        $goods['search'] = $request->search;
        $goods['category_name'] = $category_name;
            // if(!Session::get('login_buyer')){
                if ($request->search == "") {
                    if ($category_name == "") {
                        $goods['all'] = DB::table('goods')
                        ->join('categories','categories.id_category','goods.id_category')
                        ->select('goods.*','categories.*')
                        ->paginate(6);
                    } else {
                        $goods['all'] = DB::table('goods')
                        ->join('categories','categories.id_category','goods.id_category')
                        ->select('goods.*','categories.*')
                        ->where('categories.category_name', "=", $category_name)
                        ->paginate(6);
                        $goods['count_goods_category'] = DB::table('goods')
                        ->join('categories','categories.id_category','goods.id_category')
                        ->select('goods.*','categories.*')
                        ->where('goods.goods_name', 'like', '%' . $category_name . '%')
                        ->count();
                    }
                } else {
                    if ($category_name == "") {
                        $goods['all'] = DB::table('goods')
                        ->join('categories','categories.id_category','goods.id_category')
                        ->select('goods.*','categories.*')
                        ->where('goods.goods_name', 'like', '%' . $request->search . '%')
                        ->paginate(6);
                    } else {
                        $goods['all'] = DB::table('goods')
                        ->join('categories','categories.id_category','goods.id_category')
                        ->select('goods.*','categories.*')
                        ->where('categories.category_name', "=", $category_name)
                        ->paginate(6);

                    }
                }
            $goods['count_goods'] = DB::table('goods')
                ->join('categories','categories.id_category','goods.id_category')
                ->select('goods.*','categories.*')
                ->where('categories.category_name', "=" , $category_name)
                ->count();
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
            $category = DB::table('categories')
                ->select('category_name')
                ->get();
            return view('buyer.content.categories',$goods, compact('category','detail_transaction','count_data_goods','goods_w_ts'));
            }
    }


// }
