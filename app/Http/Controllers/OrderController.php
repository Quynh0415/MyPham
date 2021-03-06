<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Category;
use App\Order;
use App\OrderStatus;
use App\Product;
use App\Setting;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::all();
         return view('backend.order.index',[
             'orders' => $order,
         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orders_status = OrderStatus::all();

        return view('backend.order.index',[
            'orders_status' => $orders_status
        ]);
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
        $order = Order::findOrfail($id);
        return view('backend.order.edit',[
            'order' => $order,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        $order_status = OrderStatus::all();

        return view('backend.order.edit',[
            'orders' => $order,
            'order_status' => $order_status,
        ]);
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

        $content = $request->content;
        $id_status = $request->orders_status_id;

        $order = Order::findorFail($id);

        $order->content = $content;
        $order->orders_status_id = $id_status;
        $order->save();
        return redirect()->back()->with('msg', 'C???p nh???t ????n h??ng th??nh c??ng');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // g???i t???i h??m destroy c???a laravel ????? x??a 1 object
        // DELETE FROM ten_bang WHERE id = 33 -> execute command
        $isDelete = Order::destroy($id); // return 1 | 0, true  false

        if ($isDelete) { // x??a th??nh c??ng
            $statusCode = 200;
            $isSuccess = true;
        } else {
            $statusCode = 400;
            $isSuccess = false;
        }

        // Tr??? v??? d??? li???u json v?? tr???ng th??i k??m theo th??nh c??ng l?? 200
        return response()->json(['isSuccess' => $isSuccess], $statusCode);
    }
}
