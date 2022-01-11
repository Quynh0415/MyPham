<?php

namespace App\Http\Controllers;

use App\Article;
use App\Contact;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\User;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backend.dashboard.inven_product');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function dashboard()
    {
        $numProduct = Product::count();

        $numOrder = Order::count();

        $orders = Order::where('orders_status_id', 1)->orderby('id','DASC')->limit(10)->get();

        $numUser = User::count();

        $numTotal = Order::where('orders_status_id', 3)->sum('total');

        $numContact = Contact::count();

        $numArticle = Article::count();

        $numProcess = Order::where('orders_status_id', 0)->count();

        $numCancel = Order::where('orders_status_id', 4)->count();


//        $moneyDay = Order::whereDay('updated_at',date('d'))->where('orders_status_id',3)->sum('total');
//        $moneyMonth = Order::whereMonth('updated_at',date('m'))->where('orders_status_id',3)->sum('total');
//        $moneyYear = Order::whereYear('updated_at',date('Y'))->where('orders_status_id',3)->sum('total');


//dd($ton_kho);
        return view('backend.dashboard.dashboard',[
            'numProduct' => $numProduct,
            'numOrder' => $numOrder,
            'numUser' => $numUser,
            'numTotal' => $numTotal,
            'numContact' => $numContact,
            'numArticle' => $numArticle,
            'numProcess' => $numProcess,
            'numCancel' => $numCancel,
//            'moneyDay' => $moneyDay,
//            'moneyMonth' => $moneyMonth,
//            'moneyYear' => $moneyYear,
            'orders' =>$orders,
        ]);
    }

    public function totalProduct()
    {
        $orders = Order::where('orders_status_id',3)->orderby('id','DASC')->get();
        return view('backend.dashboard.total_product',[
            'orders' => $orders,
        ]);
    }
}
