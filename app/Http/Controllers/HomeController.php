<?php

namespace App\Http\Controllers;

use App\Article;
use App\Banner;
use App\Brand;
use App\Category;
use App\Contact;
use App\Order;
use App\Product;
use App\ProductDetail;
use App\ProductImage;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $hotProducts = Product::where('is_hot', '1')
            ->get();
        $newProducts = Product::where('prod_new', '1')
            ->get();
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

    public function product()
    {
        $banner = Banner::where('is_active', '1')->orderBy('position')->get();
        $product = Product::where(['is_active' => '1'])->get();
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
        $category = Category::where(['is_active' => 1])->where(['parents_id' => 0])->orderBy('position', 'ASC')->get();
        //$product = Product::where(['slug' => $slug], ['is_active' => 1] )->first();
        $product = Product::where(['categories_id' => $category->first()->id])->get();


        return view('frontend.product.brand_product',[
            'banner' => $banner,
            'setting' => $setting,
            'product' => $product,
            'categories' => $category,
        ]);
    }

    public function productDetail($slug)
    {
        $banner = Banner::where('is_active', '1')->orderBy('position')->get();
        $product = Product::where(['slug' => $slug], ['is_active' => 1] )->first();
        $sameProduct = Product::where([['is_active', '=', 1],
            ['brands_id', '=', $product->first()->brands_id],
            ['id', '<>' , $product->first()->id]])
            ->limit(5)->get();
        $menu = Brand::where([['is_active', '=', 1]])->orderBy('position', 'asc')->get();
        $category = Category::where(['is_active' => 1])->where(['parents_id' => 0])->orderBy('position', 'ASC')->get();
        $setting = Setting::first();
        return view('frontend.product.product_detail',[
            'product' => $product,
            'sameProduct' => $sameProduct,
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
        $contact->slug = Str::slug($request->input('name'));

        $contact->save();

        return redirect()->back()->with('msg', 'Gửi yêu cầu thành công, chúng tôi sẽ liên hệ tới bạn sớm nhất.');

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
