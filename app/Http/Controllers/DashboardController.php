<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
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
        $orders = Order::where('orders_status_id',1)->orderby('id','DASC')->limit(6)->get();


        $ton_kho = DB::table('products_detail')-> selectRaw('count(products_detail.id) as ton_kho')
            ->whereRaw('products_detail.id not in (select orders_detail.products_id  from orders_detail)')
            ->get();

        $moneyDay = Order::whereDay('updated_at',date('d'))->where('orders_status_id',3)->sum('total');
        $moneyMonth = Order::whereMonth('updated_at',date('m'))->where('orders_status_id',3)->sum('total');
        $moneyYear = Order::whereYear('updated_at',date('Y'))->where('orders_status_id',3)->sum('total');


//dd($ton_kho);
        return view('backend.dashboard.dashboard',[
            'numProduct' => $numProduct,
            'numOrder' => $numOrder,
            'moneyDay' => $moneyDay,
            'moneyMonth' => $moneyMonth,
            'moneyYear' => $moneyYear,
            'orders' =>$orders,
        ]);
    }

    public function  invenProduct()
    {
        return view('backend.dashboard.inven_product');
    }
}
