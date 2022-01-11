<?php

namespace App\Http\Controllers;

use App\Article;
use App\Banner;
use App\Brand;
use App\Category;
use App\Contact;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\ProductDetail;
use App\ProductImage;
use App\Setting;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use League\Flysystem\Exception;
use PhpParser\Node\Expr\AssignOp\Concat;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::where('is_active', '1')->orderBy('position')->get();
        $product = Product::limit(8)->get();
        $hotProducts = Product::where('is_hot', '1')->orderBy('position', 'ASC')
            ->paginate(6);
        $newProducts = Product::where('prod_new', '1')->orderBy('position', 'ASC')
            ->paginate(6);
        $article = Article::where(['is_active'=>1])->where(['is_hot'=> 1])->limit(4)->get();
        $setting = Setting::first();
        $category = Category::where(['is_active' => 1])->where(['parents_id' => 0])->orderBy('position', 'ASC')->get();
        $brand = Brand::where('is_active', '1')->limit(7)->get();
        return view('frontend.index',[
            'banner' => $banner,
            'product' => $product,
            'hotProducts' =>$hotProducts,
            'newProducts' =>$newProducts,
            'article'=> $article,
            'setting' => $setting,
            'categories' =>$category,
            'brand' => $brand,
        ]);
    }

    public function notFound()
    {
//        $banner = Banner::where('is_active', '1')->orderBy('position')->get();
//        $category = Category::where(['is_active' => 1])->where(['parents_id' => 0])->orderBy('position', 'ASC')->get();
//        $setting = Setting::first();
        return view('errors.404',[
//            'banner' => $banner,
//            'setting' => $setting,
//            'categories' => $category,
        ]);
    }

    public function product()
    {
        $banner = Banner::where('is_active', '1')->orderBy('position')->get();
        $product = Product::where(['is_active' => '1'])->paginate(18);
        $category = Category::where(['is_active' => 1])->where(['parents_id' => 0])->orderBy('position', 'ASC')->get();
        $setting = Setting::first();
        return view('frontend.product.product',[
            'product' => $product,
            'banner' => $banner,
            'setting' => $setting,
            'categories' => $category,
        ]);
    }

    public function brands($slug)
    {
        $banner = Banner::where('is_active', '1')->orderBy('position')->get();
        $setting = Setting::first();
        $brand = Brand::where(['slug' => $slug])->get();
        //$product = Product::where(['slug' => $slug], ['is_active' => 1] )->first();
        $product = Product::where(['brands_id' => $brand->first()->id])->get();
        $category = Category::where(['is_active' => 1])->where(['parents_id' => 0])->orderBy('position', 'ASC')->get();

        return view('frontend.product.brand_product',[
            'banner' => $banner,
            'setting' => $setting,
            'brand' => $brand,
            'product' => $product,
            'categories' => $category,
        ]);
    }

    public function categories($slug)
    {
        $banner = Banner::where('is_active', '1')->orderBy('position')->get();
        $setting = Setting::first();
        $categories = Category::where(['is_active' => 1])->where(['parents_id' => 0])->orderBy('position', 'ASC')->get();
        $category =  Category::where('slug',$slug)->where('is_active',1)->first();

        $products = $category->products;
//        dd($products);

        return view('frontend.product.cate_product',[
            'banner' => $banner,
            'setting' => $setting,
            'product' => $products,
            'categories' => $categories,
        ]);
    }

    public function productDetail($slug)
    {
        $banner = Banner::where('is_active', '1')->orderBy('position')->get();
        $product = Product::where(['slug' => $slug], ['is_active' => 1] )->first();
        $category = Category::where(['is_active' => 1])->where(['parents_id' => 0])->orderBy('position', 'ASC')->get();
        $setting = Setting::first();
        $brands = Brand::where(['slug' => $slug])->get();
        //$product = Product::where(['slug' => $slug], ['is_active' => 1] )->first();
        $sameProducts = Product::where([['is_active', '=', 1],
            ['brands_id', '=', $product->brands_id],
            ['id', '<>' , $product->id]])
            ->latest()->take(6)->get();
//        dd($);
        $menu = Brand::where([['is_active', '=', 1]])->orderBy('position', 'asc')->get();
        return view('frontend.product.product_detail',[
            'product' => $product,
            'sameProducts' => $sameProducts,
            'banner' => $banner,
            'setting' => $setting,
            'menu' => $menu,
            'categories' => $category,
        ]);

    }

    public function article()
    {
        $banner = Banner::where('is_active', '1')->orderBy('position')->get();
        $setting = Setting::first();
        $article = Article::where(['is_active' => '1'])->get();
        $category = Category::where(['is_active' => 1])->where(['parents_id' => 0])->orderBy('position', 'ASC')->get();


        return view('frontend.article.article', [
            'banner' => $banner,
            'setting' => $setting,
            'article' => $article,
            'categories' => $category,
        ]);
    }

    public function articleDetail($slug)
    {
        $banner = Banner::where('is_active', '1')->orderBy('position')->get();
        $setting = Setting::first();
        $article = Article::where(['slug' => $slug], ['is_active' => 1])->first();
        $category = Category::where(['is_active' => 1])->where(['parents_id' => 0])->orderBy('position', 'ASC')->get();

        $sameArticles = Article::where([['is_active', '=',  1],
            ['categories_id', '=' , $article->first()->categories_id ],
            ['id', '<>', $article->first()->id]])->limit(3)
            ->get();
//        dd($article->first()->categories_id);
        $menu = Category::where([['is_active', '=', 1]])->orderBy('position', 'asc')->get();

        return view('frontend.article.article_detail', [
            'article' => $article,
            'banner' => $banner,
            'setting' => $setting,
            'sameArticles' => $sameArticles,
            'menu' => $menu,
            'categories' => $category,
        ]);
    }

    public function contact()
    {
        $banner = Banner::where('is_active', '1')->orderBy('position')->get();
        $category = Category::where(['is_active' => 1])->where(['parents_id' => 0])->orderBy('position', 'ASC')->get();

        $setting = Setting::first();
        return view('frontend.contact.contact',[
            'banner' => $banner,
            'setting' => $setting,
            'categories' => $category,
        ]);
    }

    public function postContact(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
            //kiem tra input có name="name"
//            required: kiểm tra có bổ trống hay k, unique: kiểm tra trùng dữ liệu --tên bảng--tên cột, max: đọ dài tối đa
            'email'=>'required',
            'address'=>'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'content' => 'required'

        ], [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'address.required' => 'Địa chỉ không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
            'content.required' => 'Nội dung không được để trống',
        ]);

        $contact = new Contact();
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->address = $request->input('address');
        $contact->phone = $request->input('phone');
        $contact->content = $request->input('content');
        $contact->status = $request->input('status');
        $contact->slug = Str::slug($request->input('name'));

        $contact->save();

        return redirect()->back()->with('msg', 'Gửi yêu cầu thành công, chúng tôi sẽ liên hệ tới bạn sớm nhất.');

    }

    public function order()
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

    public function viewMessage()
    {
        $banner = Banner::where('is_active', '1')->orderBy('position')->get();
        $setting = Setting::first();
        $category = Category::where(['is_active' => 1])->where(['parents_id' => 0])->orderBy('position', 'ASC')->get();

        return view('frontend.order.message',[
            'banner' => $banner,
            'setting' => $setting,
            'categories' => $category,
        ]);
    }

    public function postOrder(Request $request)
    {
        $request->validate([
            'cus_name' => 'required|max:255',
            //kiem tra input có name="name"
//            required: kiểm tra có bổ trống hay k, unique: kiểm tra trùng dữ liệu --tên bảng--tên cột, max: đọ dài tối đa
            'cus_email'=>'required',
  //          'cus_address'=>'required',
            'cus_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ], [
            'cus_name.required' => 'Tên không được để trống',
            'cus_email.required' => 'Email không được để trống',
   //         'cus_address.required' => 'Địa chỉ không được để trống',
            'cus_phone.required' => 'Số điện thoại không được để trống',
        ]);
        $cart = Cart::content();
        $subPrice =intval(Cart::subtotal(0,"",""));
//        dd($subPrice);

        $order = new Order();
        $order->cus_name = $request->input('cus_name');
        $order->cus_email = $request->input('cus_email');
        $order->cus_phone = $request->input('cus_phone');
        $order->cus_address = $request->input('cus_address');
        $order->other_address = $request->input('other_address');
        $order->total = $request->input('total');
        $order->subtotal = $request->input('subtotal');
        $order->discount = $request->input('discount');
        $order->content = $request->input('content');
        $order->total = $subPrice;
        $order->orders_status_id = 1;
        $order->save();
        $maDonHang = 'DH-'.$order->id.'-'.date('d').date('m').date('Y'); // Tạo mã đơn hàng.
        $order->code = $maDonHang;
        $order->save();

//dd($cart);
        foreach ($cart as $key => $item) {
            $_detail = new OrderDetail();
            $_detail->orders_id = $order->id;
            $_detail->name = $item->name;
//                $_detail->package = $item->options->package;
            $_detail->image = $item->options->image;
            $_detail->products_id = $item->id;
            $_detail->quantity = $item->qty;
            $_detail->price = $item->price;
//            dd( $item->size);
            $_detail->color_size = $item->options['color_size'];
            $product = ProductDetail::where([['products_id', '=', $item->id ],['color', 'LIKE',$item->options->color]])
                ->orWhere([['products_id', '=', $item->id ],['size' , 'LIKE', $item->options->size]])->first();
            $old_stock =  $product->stock;
            $product->stock = $old_stock - $item->qty;
            $product->save();
            $_detail->save();

        }

        $to_mail = $order->cus_email;
        $content =array('name'=>$order->cus_name,'email'=>$order->cus_email, 'address' =>$order->cus_address,
            'orderId'=>$maDonHang, 'phone'=>$order->cus_phone,
            'total'=>$order->total, 'item' => $cart,

        );
        //        $order = $this->postOrder($request, null);
        Mail::send('email.email', $content,
            function($message) use ($to_mail){
                $message->to($to_mail, 'Beauty Mona')->subject('Đơn hàng mới');
                $message->from('admin@BeautyMona.com', 'Beauty Mona');
            });

            Cart::destroy();
            return redirect()->route('msg')->with('msg', 'Cảm ơn bạn đã đặt hàng. Chúng tôi sẽ giao hàng tới bạn trong thời gian sớm nhất. Mã đơn hàng của bạn là: #'.$order->code);

    }

    public function search(Request $request)
    {
        $banner = Banner::where('is_active', '1')->orderBy('position')->get();
        $setting = Setting::first();
        $category = Category::where(['is_active' => 1])->where(['parents_id' => 0])->orderBy('position', 'ASC')->get();

        // b1. Lấy từ khóa tìm kiếm
        $keyword = $request->input('tu-khoa');

        $slug = Str::slug($request->input('tu-khoa'));

        //$sql = "SELECT * FROM products WHERE is_active = 1 AND slug like '%$keyword%'";

        $products = Product::where([['slug', 'like', '%' . $slug . '%'], ['is_active', '=', 1]])->get();

//        $totalResult = $product->total(); // số lượng kết quả tìm kiếm

        return view('frontend.product.search_product', [
            'products' => $products,
//            'totalResult' => $totalResult,
            'keyword' => $keyword,
            'banner' => $banner,
            'setting' => $setting,
            'categories' => $category,
        ]);
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
}
