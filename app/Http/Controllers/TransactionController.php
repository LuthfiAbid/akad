<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Transaction;
use App\DetailTransaction;
use App\Goods;
use Hash;
use DB;

class TransactionController extends Controller
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

    public function searchCategory(Request $request){
        $goods['search'] = $request->search;
        if ($request->search == "") {
            $goods['all'] = DB::table('goods')
            ->join('categories','categories.id_category','goods.id_category')
            ->select('goods.*','categories.*')
            ->paginate(6);
            $goods['count_goods'] = DB::table('goods')
            ->join('categories','categories.id_category','goods.id_category')
            ->select('goods.*','categories.*')
            ->where('goods.goods_name', 'like', '%' . $request->search . '%')
            ->count();
        } else {
            $goods['all'] = DB::table('goods')
            ->join('categories','categories.id_category','goods.id_category')
            ->select('goods.*','categories.*')
            ->where('goods.goods_name', 'like', '%' . $request->search . '%')
            ->paginate(6);
            $goods['count_goods'] = DB::table('goods')
            ->join('categories','categories.id_category','goods.id_category')
            ->select('goods.*','categories.*')
            ->where('goods.goods_name', 'like', '%' . $request->search . '%')
            ->count();
        }
        $detail_transaction = DB::table('transaction')
                    ->join('detail_transaction','transaction.id_transaction','detail_transaction.id_transaction')
                    ->join('goods','detail_transaction.id_goods','goods.id_goods')
                    ->join('categories','categories.id_category','goods.id_category')
                    ->select('goods.*','detail_transaction.*','transaction.*','categories.category_name as cat_name')
                    ->where('id_buyer',"=", Session::get('id_buyer'))
                    ->where('isdone', "=", "0")
                    ->get();
        return view('buyer.content.categories',$goods, compact('detail_transaction'));
    }


    public function viewChart(Request $request){
        $good['search'] = $request->search;
        $detail_transaction = DB::table('transaction')
                    ->join('detail_transaction','transaction.id_transaction','detail_transaction.id_transaction')
                    ->join('goods','detail_transaction.id_goods','goods.id_goods')
                    ->join('categories','categories.id_category','goods.id_category')
                    ->select('goods.*','detail_transaction.*','transaction.*','categories.category_name as cat_name')
                    ->where('id_buyer',"=", Session::get('id_buyer'))
                    ->where('isdone', "=", "0")
                    ->get();
        return view('buyer.content.view_chart',$good, compact('detail_transaction'));
    }

    public function viewCheckout(Request $request){
        $good['search'] = $request->search;
        $detail_transaction = DB::table('transaction')
                    ->join('detail_transaction','transaction.id_transaction','detail_transaction.id_transaction')
                    ->join('goods','detail_transaction.id_goods','goods.id_goods')
                    ->join('categories','categories.id_category','goods.id_category')
                    ->select('goods.*','detail_transaction.*','transaction.*','categories.category_name as cat_name')
                    ->where('id_buyer',"=", Session::get('id_buyer'))
                    ->where('isdone', "=", "0")
                    ->get();
        return view('buyer.content.checkout',$good, compact('detail_transaction'));
    }

    public function getViewGoods(Request $request, $id_goods)
    {
        $good['search'] = $request->search;
        //    $data = Session::get('buyer_name');
           $data_goods = DB::table('goods')
                        ->join('categories','categories.id_category','goods.id_category')
                        ->select('goods.*','categories.category_name as cat_name')
                        ->where('id_goods',$id_goods)
                        ->first();
            $goods = DB::table('goods')
                        ->join('categories','categories.id_category','goods.id_category')
                        ->select('goods.*','categories.category_name as cat_name')
                        ->orderBy('id_goods','ASC')
                        ->limit(4)
                        ->get();
            $detail_transaction = DB::table('transaction')
                        ->join('detail_transaction','transaction.id_transaction','detail_transaction.id_transaction')
                        ->join('goods','detail_transaction.id_goods','goods.id_goods')
                        ->join('categories','categories.id_category','goods.id_category')
                        ->select('goods.*','detail_transaction.*','transaction.*','categories.category_name as cat_name')
                        ->where('id_buyer',"=", Session::get('id_buyer'))
                        ->where('isdone', "=", "0")
                        ->get();
           return view('buyer.content.product',$good, compact('data_goods','goods','detail_transaction'));

    }

    public function viewCountSubtotal(Request $request){
        $count = DB::table('detail_transaction')
            ->where('id_transaction', "=", $request->id_transaction)
            ->sum('qty');

            $sum = DB::table('detail_transaction')
            ->where('id_transaction', "=", $request->id_transaction)
            ->sum('subtotal');

             $data = array('data_count'=>$count, 'data_sum'=>$sum);

           echo json_encode($data);

    }



    public function createTransaction(Request $request)
    {
        try {
            $count = DB::table('transaction')
            ->where('id_buyer', "=", Session::get('id_buyer'))
            ->where('isdone', "=", '0')
            ->orderBy('id_buyer', 'DESC')
            ->count();

                if (empty($count)) {
                    $transaction = new Transaction();
                    $transaction->id_buyer = Session::get('id_buyer');
                    $transaction->isdone = 0;
                    $transaction->save();

                    $get_hd = DB::table('transaction')
                        ->select("transaction.id_transaction")
                        ->where('id_buyer', "=", Session::get('id_buyer'))
                        ->where('isdone', "=", '0')
                        ->orderBy('id_buyer', 'DESC')
                        ->first();

                    $id_transaction = $get_hd->id_transaction;

                    $detail_transaction = new DetailTransaction();
                    $detail_transaction->id_transaction =  $id_transaction;
                    $detail_transaction->id_goods = $request->id_goods;
                    $detail_transaction->qty =  $request->qty;
                    $detail_transaction->subtotal =  $request->subtotal;
                    $detail_transaction->save();

                }else {

                    $get_hd = DB::table('transaction')
                        ->select("transaction.id_transaction")
                        ->where('id_buyer', "=", Session::get('id_buyer'))
                        ->where('isdone', "=", '0')
                        ->orderBy('id_buyer', 'DESC')
                        ->first();

                    $id_transaction = $get_hd->id_transaction;

                    $get_detail = DB::table('detail_transaction')
                        ->select("detail_transaction.id_detail")
                        ->where('id_transaction', "=", $id_transaction)
                        ->where('id_goods', "=", $request->id_goods)
                        ->count();

                    $get_id_detail = $get_detail;

                    if (empty($get_id_detail)) {
                       $detail_transaction = new DetailTransaction();
                       $detail_transaction->id_transaction =  $id_transaction;
                       $detail_transaction->id_goods = $request->id_goods;
                       $detail_transaction->qty =  $request->qty;
                       $detail_transaction->subtotal =  $request->subtotal;
                       $detail_transaction->save();
                    }else{

                        $get_detail = DB::table('detail_transaction')
                        ->select("detail_transaction.id_detail")
                        ->where('id_transaction', "=", $id_transaction)
                        ->where('id_goods', "=", $request->id_goods)
                        ->first();

                    $get_id_detail = $get_detail->id_detail;

                        $goods = DB::table('goods')
                        ->join('detail_transaction','goods.id_goods','detail_transaction.id_goods')
                        ->select('goods.*','detail_transaction.*')
                        ->where('id_detail', "=", $get_id_detail)
                        ->first();

                        $qty = $request->qty;
                        $sum_qty = $qty + $goods->qty;
                        $price = $goods->price;
                        $subtotal = $sum_qty * $price;

                        $data = DetailTransaction::findOrFail($get_id_detail);
                        $data->qty = $sum_qty;
                        $data->subtotal = $subtotal;
                        $data->save();
                    }

                }
                echo 1;
        } catch (\Throwable $th) {
            echo 0;
        }


    }

    public function updateTransaction(Request $request)
    {
        $id_transaction = $request->id_transaction;
        $total_price = $request->total_price;

        $transaction = Transaction::firstOrNew(['id_transaction' => $id_transaction]);
        $transaction->total_price = $request->total_price;
        $transaction->isdone = 1;
        $transaction->save();
            if ($transaction) {
                echo 1;
            } else {
                echo 0;
            }
    }

    public function deleteDetail(Request $request)
    {
        try {
            $id = $request->id_detail;
            $data = DetailTransaction::findOrFail($id);
            $data->delete();
            echo 1;
        } catch (\Throwable $th) {
            echo 0;
        }

    }

    public function updateQty(Request $request)
    {

        $id = $request->id_detail;
        $qty = $request->qty;

        $goods = DB::table('goods')
                        ->join('detail_transaction','goods.id_goods','detail_transaction.id_goods')
                        ->select('goods.*','detail_transaction.*')
                        ->where('id_detail', "=", $id)
                        ->first();

        $qty_detil = $goods->qty;
        $stock_goods = $goods->stock;
        $id_goods = $goods->id_goods;

        $data_goods = Goods::findOrFail($id_goods);
        if ($qty >= $qty_detil) {
            $qty_min = $qty - $qty_detil;
            $data_goods->stock = $stock_goods - $qty_min;
        }else{
            $qty_add = $qty_detil - $qty;
            $data_goods->stock = $stock_goods + $qty_add;
        }
        $data_goods->save();

        $price = $goods->price;
        $subtotal = $qty * $price;

        $data = DetailTransaction::findOrFail($id);
        $data->qty = $request->qty;
        $data->subtotal = $subtotal;
        $data->save();
            if ($data) {
                echo 1;
            } else {
                echo 0;
            }
    }

    public function returnGrandTotal(Request $request){
        $count = DB::table('detail_transaction')
            ->where('id_transaction', "=", $request->id_transaction)
            ->sum('qty');

            $sum = DB::table('detail_transaction')
            ->where('id_transaction', "=", $request->id_transaction)
            ->sum('subtotal');

        return view('buyer.content.returnGrandTotal', compact('count', 'sum'));
        //      $data = array('data_count'=>$count, 'data_sum'=>$sum);

        //    echo json_encode($data);

    }


}
