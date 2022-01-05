<?php

namespace App\Http\Controllers;

use App\Article;
use App\Banner;
use App\Brand;
use App\Category;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\ProductDetail;
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

        $carts = Cart::content();
//        dd($carts);
        foreach ($carts as $item){
            $product = ProductDetail::where([['products_id', '=', $item->id ],['color', 'LIKE',$item->options->color]])
                ->orWhere([['products_id', '=', $item->id ],['size' , 'LIKE', $item->options->size]])->first();
            if (is_object($product)){
                Cart::update($item->rowId,[
                    'price' =>  $product->price - 0.01*$product->price*$product->sale
                ]);
            }
        }
//        dd(Cart::content());
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
        $cart = Cart::content();
        if(is_null($product_detail->size)){
            $color_size = $product_detail->color;
        }else{
            $color_size = $product_detail->size;
        }
        foreach ($cart as $key => $item) {
            if($item->id == $product->id && $color_size == $item->options['color_size'] && $item->qty + (int)$request->qty > $product_detail->stock){
                return redirect()->route('chitietsanpham',$product->slug)->with('warning','Số lượng sản phẩm vượt quá số lượng có trong kho');
            }
        }

        Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => (int)$request->qty,
            'price' => (int)$product_detail->price,
            'options' => ['detail' => $product_detail->id,
                'sale' => (int)$product_detail->sale,
                'image' => $product->image,
                'color_size' => $color_size,
                'max' => $product_detail->stock,
            'url' => route('chitietsanpham',['slug' => $product->slug])]]);
        return redirect()->back();

    }


    public function clearCart()
    {
        Cart::destroy();
    }

    public function removeProduct($rowId)
    {
        $banner = Banner::where('is_active', '1')->orderBy('position')->get();
        $setting = Setting::first();
        $category = Category::where(['is_active' => 1])->where(['parents_id' => 0])->orderBy('position', 'ASC')->get();

        Cart::remove($rowId);

        return view('frontend.order.order',[
            'banner' => $banner,
            'setting' => $setting,
            'categories' =>$category,

        ]);

    }

    public function removeCart()
    {
        Cart::destroy();
    }
    public function update(Request $request)
    {
        $rowId = $request->input('rowId');
        $qty = (int) $request->input('qty');

        $item = Cart::get($rowId);
        $product_detail= ProductDetail::where([['products_id' , '=', $item->id], ['color', '=', $item->options->color_size]])
            ->orWhere([['products_id' , '=', $item->id], ['size', '=', $item->options->color_size]])->first();
//        dd($item);
        if($qty > $product_detail->stock){
            return response()->json(['msg' => 'Số sản phẩm trong kho của shop đã đạt  giới hạn'], 400);
        }
        Cart::update($rowId, $qty);

        session(['totalItem' => Cart::count()]);
        $cart = Cart::content();
        $totalPrice = Cart::subtotal(0,",","."); // lấy tổng giá của sản phẩm

        $list = array();

        foreach ($cart as $item){
            $list[$item->rowId] = $item;
         }
//        return view('frontend.order.order',[
//            'setting' => $setting,
//            'categories' => $category,
//        ]);
//
//        $cart = Session::get('cart');
//
//        foreach ($cartdata->all() as $id => $val)
//        {
//            if ($val > 0) {
//                $cart[$id]['qty'] += $val;
//            } else {
//                unset($cart[$id]);
//            }
//        }
//        Session::put('cart', $cart);
        return response()->json(['totalPrice' => $totalPrice, 'list'=> $list], 200);
    }
}
