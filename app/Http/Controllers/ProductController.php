<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use App\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return view('backend.product.index',['product' => $product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('backend.product.create' ,[
            'categories' => $categories,
            'brands' => $brands,
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
            'name' => 'required|unique:products,name|max:255',
            //kiem tra input có name="name"
//            required: kiểm tra có bổ trống hay k, unique: kiểm tra trùng dữ liệu --tên bảng--tên cột, max: đọ dài tối đa
            'image' => 'required|mimes:ipeg,jpg,png',
            'categories_id' => 'required|exists:categories,id',
            'brands_id' => 'required|exists:brands,id',
            //exit kiểm tra dữ liệu có tồn tại trong bảng categories cột id hay k
           // 'content' => 'required',
            'is_active' => 'integer|min:0|max:1',
        ], [
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.unique' => 'Dữ liệu bị trùng',
            'name.max' => 'Độ dài tối đa 255 kí tự',
            'image.required' => 'Yêu cầu không được để trống',
            'image.mimes' => 'Không đúng định dạng ảnh',
            'categories_id.exists'=>'Bạn chưa chọn danh mục sản phẩm',
            'brands_id.exists'=>'Bạn chưa chọn thương hiệu sản phẩm',
           // 'content.required' => 'Bạn chưa nhập nội dung',
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->categories_id = $request->input('categories_id');
        $product->brands_id = $request->input('brands_id');
        $product->content = $request->input('content');
        $product->position = $request->input('position');
        $product->description = $request->input('description');
        $product->slug = Str::slug($request->input('name'));
        // Upload file
        if ($request->hasFile('image')) { // dòng này Kiểm tra xem có image có được chọn
            // get file
            $file = $request->file('image');
            // đặt tên cho file image
            $filename = time().'_'.$file->getClientOriginalName(); // $file->getClientOriginalName() == tên ban đầu của image
            // Định nghĩa đường dẫn sẽ upload lên
            $path_upload = 'uploads/product/';
            // Thực hiện upload file
            $file->move($path_upload,$filename); // upload lên thư mục public/uploads/product

            $product->image = $path_upload.$filename;
        }
        $is_active = 0;// mặc định gán không hiển thị
        if ($request->has('is_active')) { // kiem tra is_active co ton tai khong ?
            $is_active = $request->input('is_active');
        }
        $product->is_active = $is_active;

        // Sản phẩm Hot
        $is_hot = 0 ;
        if ($request->has('is_hot')){
            $is_hot = $request->input('is_hot');
        }
        $product->is_hot=$is_hot;

        //San pham moi
        $prod_new = 0 ;
        if ($request->has('prod_new')){
            $prod_new = $request->input('prod_new');
        }
        $product->prod_new=$prod_new;

        $product->save();

        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findorFail($id);
        return view('backend.product.show', ['data' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();

        return view('backend.product.edit', [
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands,
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
            'name' => 'required|max:255|unique:products,name,'.$id,
            //kiem tra input có name="name"
//            required: kiểm tra có bổ trống hay k, unique: kiểm tra trùng dữ liệu --tên bảng--tên cột, max: đọ dài tối đa
            'new_image' => 'mimes:ipeg,jpg,png',
            // 'type' => 'required',
            'categories_id' => 'exists:categories,id',
            'brands_id' => 'exists:brands,id',
            //exit kiểm tra dữ liệu có tồn tại trong bảng categories cột id hay k
           // 'content' => 'required',
//            'is_active' => 'integer|min:0|max:1',
        ], [
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.unique' => 'Dữ liệu bị trùng',
            'name.max' => 'Độ dài tối đa 255 kí tự',
//            'new_image.required' => 'Yêu cầu không được để trống',
            'new_image.mimes' => 'Không đúng định dạng ảnh',
            'categories_id.exists'=>'Bạn chưa chọn danh mục sản phẩm',
            'brands_id.exists'=>'Bạn chưa chọn thương hiệu sản phẩm',
            //'content.required' => 'Bạn chưa nhập nội dung',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->categories_id = $request->input('categories_id');
        $product->brands_id = $request->input('brands_id');
        $product->content = $request->input('content');
        $product->position = $request->input('position');
        $product->description = $request->input('description');
        $product->slug = Str::slug($request->input('name'));
        // Upload file
        if ($request->hasFile('new_image')) { // dòng này Kiểm tra xem ảnh mới có được chọn
            // xóa file cũ
            @unlink(public_path($product->image)); // hàm unlink của PHP không phải laravel , chúng ta thêm @ đằng trước tránh bị lỗi
            // get new_image
            $file = $request->file('new_image');
            // đặt tên cho file new_image
            $filename = time().'_'.$file->getClientOriginalName(); // $file->getClientOriginalName() == tên ban đầu của image
            // Định nghĩa đường dẫn sẽ upload lên
            $path_upload = 'uploads/product/';
            // Thực hiện upload file
            $file->move($path_upload, $filename);

            $product->image = $path_upload.$filename; // gán giá trị ảnh mới cho thuộc tính image của đối tượng
        }

        $is_active = 0;// mặc định gán không hiển thị
        if ($request->has('is_active')) { // kiem tra is_active co ton tai khong ?
            $is_active = $request->input('is_active');
        }
        $product->is_active = $is_active;

        // Sản phẩm Hot
        $is_hot = 0 ;
        if ($request->has('is_hot')){
            $is_hot = $request->input('is_hot');
        }
        $product->is_hot=$is_hot;

        //San pham moi
        $prod_new = 0 ;
        if ($request->has('prod_new')){
            $prod_new = $request->input('prod_new');
        }
        $product->prod_new=$prod_new;

        $product->save();

        return redirect()->route('admin.product.edit',$id);
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
        $isDelete = Product::destroy($id); // return 1 | 0, true  false

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
    public function  changeStatus(Request $request) {
        $product = Product::findOrFail($request->id);
        if($product) {
            $product->is_active = $request->is_active;
            $product->save();

            return response()->json($product);
        }else {
            return response('Có lỗi xảy ra', 404);
        }
    }



}
