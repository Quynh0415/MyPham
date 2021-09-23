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
        return view('backend.product.edit',['product' => $product]);
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
        $request->validate([
            'size' => 'required|unique:products_detail,size',
            'stock' => 'required',
        ],[
            'size.required' => 'Thể tích không được để trống',
            'stock.required' => 'Số lượng không được để trống'
        ]);
        $product_detail = new ProductDetail();
        $product_detail->products_id = $request->input('products_id');
        $product_detail->size = $request->input('size');
        $product_detail->stock = $request->input('stock');
        $product_detail->description = $request->input('description');
        $product_detail->slug = Str::slug($request->input('products_id'));

        // Sản phẩm Hot
        $is_hot = 0 ;
        if ($request->has('is_hot')){
            $is_hot = $request->input('is_hot');
        }
        $product_detail->is_hot=$is_hot;

        //San pham moi
        $prod_new = 0 ;
        if ($request->has('prod_new')){
            $is_hot = $request->input('prod_new');
        }
        $product_detail->prod_new=$prod_new;

        $product_detail->save();

        return redirect()->route('product.index');

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
            'size' => 'required|unique:products_detail,size',
            'stock' => 'required',
        ],[
            'size.required' => 'Thể tích không được để trống',
            'stock.required' => 'Số lượng không được để trống'
        ]);
        $product_detail = ProductDetail::findOrFail($id);
        $product_detail->products_id = $request->input('products_id');
        $product_detail->size = $request->input('size');
        $product_detail->stock = $request->input('stock');
        $product_detail->description = $request->input('description');
        $product_detail->slug = Str::slug($request->input('products_id'));

        // Sản phẩm Hot
        $is_hot = 0 ;
        if ($request->has('is_hot')){
            $is_hot = $request->input('is_hot');
        }
        $product_detail->is_hot=$is_hot;

        //San pham moi
        $prod_new = 0 ;
        if ($request->has('prod_new')){
            $is_hot = $request->input('prod_new');
        }
        $product_detail->prod_new=$prod_new;

        $product_detail->save();

        return redirect()->route('product.edit');
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
