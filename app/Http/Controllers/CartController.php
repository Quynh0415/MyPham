<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Category;
use App\Product;
use App\Setting;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::where('is_active', '1')->orderBy('position')->get();
        $setting = Setting::first();
        $category = Category::where(['is_active' => 1])->where(['parents_id' => 0])->orderBy('position', 'ASC')->get();

        return view('frontend.order.order',[
            'banner' => $banner,
            'setting' => $setting,
            'categories' => $category,
            ]);
    }

    public function addProduct(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product_detail = $product->products_detail()->where('id', $request->options)->first();
        Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => (int)$request->qty,
            'price' => (int)$product_detail->price,
            'options' => ['detail' => $product_detail->id,
                'sale' => (int)$product_detail->sale,
                'image' => asset($product->image),
                'size' => $product_detail->size,
                'color' => $product_detail->color,
            'url' => route('chitietsanpham',['slug' => $product->slug])]]);
        return redirect()->back();
    }

    public function orderDetail()
    {
        $banner = Banner::where('is_active', '1')->orderBy('position')->get();
        $setting = Setting::first();
        $category = Category::where(['is_active' => 1])->where(['parents_id' => 0])->orderBy('position', 'ASC')->get();

        return view('frontend.order.order_detail',[
            'banner' => $banner,
            'setting' => $setting,
            'categories' => $category,
        ]);
    }

    public function clearCart()
    {
        Cart::destroy();
    }

    public function removeProduct($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back();
    }
}
