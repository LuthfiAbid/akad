<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Transaction;
use App\DetailTransaction;
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

    public function getViewGoods($id_goods)
    {

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
           return view('buyer.content.product',compact('data_goods','goods'));

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

                    $detail_transaction = new DetailTransaction();
                    $detail_transaction->id_transaction =  $id_transaction;
                    $detail_transaction->id_goods = $request->id_goods;
                    $detail_transaction->qty =  $request->qty;
                    $detail_transaction->subtotal =  $request->subtotal;
                    $detail_transaction->save();
                }
                echo 1;
        } catch (\Throwable $th) {
            echo 2;
        }


    }


}
