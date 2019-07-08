<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use App\TransactionAkad;
use App\DetailTransaction;
use Currency;
use Redirect;
use Session;
use Alert;
use Hash;
use URL;
use DB;

class TransactionController extends Controller
{
    //
    public function __construct()
    {
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
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
                    // dd($detail_transaction);
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
                    $transaction = new TransactionAkad();
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
        $dataTotal = round($request->total_price/14113,2);
        $idTransaction = $request->id_transaction;
        $dataQty = DB::table('detail_transaction')
        ->where('id_transaction',$idTransaction)
        ->sum('qty');
        $dataPrice = DB::table('detail_transaction')
        ->where('id_transaction',$idTransaction)
        ->select('subtotal')
        ->get();
        // dd($dataPrice);
        $dataName = DB::table('detail_transaction')
        ->join('goods','goods.id_goods','detail_transaction.id_goods')
        ->where('id_transaction',$idTransaction)
        ->select('goods_name')
        ->get();
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Item Shop') /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($dataTotal); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($dataTotal);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
                    ->setItemList($item_list)
                    ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('status')) /** Specify return URL **/
                      ->setCancelUrl(URL::to('status'));
        $payment = new Payment();
        $payment->setIntent('Sale') 
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));
        // dd($payment->create($this->_api_context));
        // exit;
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return Redirect::to('/buyer/home');
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/buyer/home');
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        Session::put('amount', $amount->getTotal());
        Session::put('id_transaction',$idTransaction);
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('/');
        // $id_transaction = $request->id_transaction;
        // $total_price = $request->total_price;

        // $transaction = Transaction::firstOrFail(['id_transaction' => $id_transaction]);
        // $transaction->total_price = $request->total_price;
        // $transaction->isdone = 1;
        // $transaction->save();
        //     if ($transaction) {
        //         echo 1;
        //     } else {
        //         echo 0;
        //     }
    }
    public function getPaymentStatus(Request $request)
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error', 'Payment failed');
            return redirect()->back();
        }
        
        $payment = Payment::get($payment_id, $this->_api_context);
        $amountFromPaypal = Session::get('amount');
        $idTransaction = Session::get('id_transaction');
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {
            $detail_transaction = DB::table('transaction')->where('id_transaction',$idTransaction)->update([
                'total_price' => round($amountFromPaypal*14113,2),
                'isdone' => '1',
            ]);
            Alert::success('Payment Succesfully!','Success')->autoclose(2000);
            return Redirect::to('buyer/home');
        }
            Alert::error('Payment Failed!','Error')->autoclose(2000);
            return redirect()->back();
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
