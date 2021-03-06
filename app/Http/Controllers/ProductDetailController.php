<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return view('backend.product.edit',[
            'product' => $product,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::all();

        return view('backend.product.edit', [
            'product' => $product,
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
        //dd($request->all());
        $request->validate([
            'stock' => 'required',
            'price' => 'required',
            'sale' => 'required',
        ],[
            'stock.required' => 'Số lượng không được để trống',
            'price.required' => 'Đơn giá không được để trống',
//            'sale.required' => 'Giá KM không được để trống',
        ]);
        $product_detail = new ProductDetail();
        $product_detail->size = $request->input('size');
        $product_detail->products_id = $request->input('product_id');
        $product_detail->stock = $request->input('stock');
        $product_detail->quantity = $request->input('quantity');
        $product_detail->price = $request->input('price');
        $product_detail->sale = $request->input('sale');
        $product_detail->color = $request->input('color');

        $product_detail->save();

        return redirect()->route('admin.product.edit', $request->product_id);

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
        $product_detail = ProductDetail::findOrFail($id);

        return view('backend.product.edit', [
            'product_detail' => $product_detail
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
        $request->validate([
            'stock' => 'required',
            'price' => 'required',
            'sale' => 'required',
        ],[
            'stock.required' => 'Số lượng không được để trống',
            'price.required' => 'Đơn giá không được để trống',
//            'sale.required' => 'Giá KM không được để trống',
        ]);
        $product_detail = ProductDetail::findOrFail($id);
        $product_detail->size = $request->input('size');
        $product_detail->stock = $request->input('stock');
        $product_detail->quantity = $request->input('quantity');
        $product_detail->price = $request->input('price');
        $product_detail->sale = $request->input('sale');
        $product_detail->color = $request->input('color');



        $product_detail->save();
//dd(route('product.edit',$request->product_id));
        return redirect()->route('admin.product.edit',$request->product_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // gọi tới hàm destroy của laravel để xóa 1 object
        // DELETE FROM ten_bang WHERE id = 33 -> execute command
        $isDelete = ProductDetail::destroy($id); // return 1 | 0, true  false

        if ($isDelete) { // xóa thành công
            $statusCode = 200;
            $isSuccess = true;
        } else {
            $statusCode = 400;
            $isSuccess = false;
        }

        // Trả về dữ liệu json và trạng thái kèm theo thành công là 200
        return response()->json(['isSuccess' => $isSuccess], $statusCode);
    }
}
