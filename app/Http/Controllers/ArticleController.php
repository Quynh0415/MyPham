<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = Article::all();

        return view('backend.article.index', ['data' => $article]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('backend.article.create',[
            'categories' => $categories
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
            'title' => 'required|unique:articles,title|max:255',
            //kiem tra input có name="name"
            'categories_id' => 'required|exists:categories,id',

//            required: kiểm tra có bổ trống hay k, unique: kiểm tra trùng dữ liệu --tên bảng--tên cột, max: đọ dài tối đa
            'image' => 'required|mimes:ipeg,jpg,png',
            //exit kiểm tra dữ liệu có tồn tại trong bảng categories cột id hay k

            'position' => 'required|integer|min:0',
            'is_active' => 'integer|min:0|max:1',
            'content'=>'required',
            'description'=>'required',
        ], [
            'title.required' => 'Tên danh mục không được để trống',
            'title.unique'=> 'Dữ liệu bị trùng',
            'title.max' => 'Độ dài tối đa 255 kí tự',
            'image.required' => 'Yêu cầu không được để trống',
            'image.mimes' => 'Không đúng định dạng ảnh',
            'categories_id.exists'=>'Bạn chưa chọn danh mục sản phẩm',
            'content.required'=>'Tóm tắt k đk để trống',
            'description.required'=>'Mô tả không được để trống'
        ]);
        $article = new Article();
        $article->title = $request->input('title');
        $article->slug = Str::slug($request->input('title'));
        $article->content = $request->input('content');
        $article->position = $request->input('position');
        $article->description = $request->input('description');

        if ($request->hasFile('image')) { // dòng này Kiểm tra xem có image có được chọn
            // get file
            $file = $request->file('image');
            // đặt tên cho file image
            $filename = time().'_'.$file->getClientOriginalName(); // $file->getClientOriginalName() == tên ban đầu của image
            // Định nghĩa đường dẫn sẽ upload lên
            $path_upload = 'uploads/article/';
            // Thực hiện upload file
            $file->move($path_upload,$filename); // upload lên thư mục public/uploads/article

            $article->image = $path_upload.$filename;
        }
        if ($request->has('is_active')) { // kiem tra is_active co ton tai khong ?
            $is_active = $request->input('is_active');
        }
        $article->is_active = $is_active;

        $article->categories_id = $request->input('categories_id');

        // Tin tức mới
        $is_hot = 0 ;
        if ($request->has('is_hot')){
            $is_hot = $request->input('is_hot');
        }
        $article->is_hot=$is_hot;

        $article->save();

        return redirect()->route('admin.article.index');
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
        $articles = Article::find($id);
        $categories = Category::all();

        return view('backend.article.edit', [
            'data' => $articles,
            'categories' => $categories,
            //'vendors' => $vendors
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
            'title' => 'required|max:255|unique:articles,title,'.$id,
            //kiem tra input có name="name"
            'categories_id' => 'required|exists:categories,id',

//            required: kiểm tra có bổ trống hay k, unique: kiểm tra trùng dữ liệu --tên bảng--tên cột, max: đọ dài tối đa
            //'image' => 'required|image',
            //exit kiểm tra dữ liệu có tồn tại trong bảng categories cột id hay k

            //'position' => 'required|integer|min:0',
            //'is_active' => 'integer|min:0|max:1',
            'content'=>'required',
            'description'=>'required',
        ], [
            'title.required' => 'Tên danh mục không được để trống',
            'title.unique' => 'Dữ liệu bị trùng',
            'title.max' => 'Độ dài tối đa 255 kí tự',
            //'image.required' => 'Yêu cầu không được để trống',
            //'image.image' => 'Không đúng định dạng ảnh',
            'categories_id.exists'=>'Bạn chưa chọn danh mục sản phẩm',
            'content.required'=>'Tóm tắt k được để trống',
            'description.required'=>'Mô tả không được để trống',
        ]);
        $article = Article::findOrFail($id);
        $article->title = $request->input('title');
        $article->slug = Str::slug($request->input('title'));
        $article->content = $request->input('content');
        $article->position = $request->input('position');
        $article->description = $request->input('description');

        if ($request->hasFile('new_image')) { // dòng này Kiểm tra xem ảnh mới có được chọn
            // xóa file cũ
            @unlink(public_path($article->image)); // hàm unlink của PHP không phải laravel , chúng ta thêm @ đằng trước tránh bị lỗi
            // get new_image
            $file = $request->file('new_image');
            // đặt tên cho file new_image
            $filename = time() . '_' . $file->getClientOriginalName(); // $file->getClientOriginalName() == tên ban đầu của image
            // Định nghĩa đường dẫn sẽ upload lên
            $path_upload = 'uploads/article/';
            // Thực hiện upload file
            $file->move($path_upload, $filename);

            $article->image = $path_upload . $filename; // gán giá trị ảnh mới cho thuộc tính image của đối tượng
        }
        if ($request->has('is_active')) { // kiem tra is_active co ton tai khong ?
            $is_active = $request->input('is_active');
        }
        $article->is_active = $is_active;

        $article->categories_id = $request->input('categories_id');

        // Tin tức mới
        $is_hot = 0 ;
        if ($request->has('is_hot')){
            $is_hot = $request->input('is_hot');
        }
        $article->is_hot=$is_hot;

        $article->save();

        return redirect()->route('admin.article.index');
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
        $isDelete = Article::destroy($id); // return 1 | 0, true  false

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
