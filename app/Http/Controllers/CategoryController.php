<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return view('backend.category.index', ['data' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();

        return view('backend.category.create', ['data' => $category]);
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
            'name' => 'required|unique:categories,name|max:255',
            //kiem tra input có name="name"
//            required: kiểm tra có bổ trống hay k, unique: kiểm tra trùng dữ liệu --tên bảng--tên cột, max: đọ dài tối đa
            'image' => 'required|mimes:ipeg,jpg,png',
            //exit kiểm tra dữ liệu có tồn tại trong bảng categories cột id hay k

            'position' => 'required|integer|min:0',
            'is_active' => 'integer|min:0|max:1',
        ], [
            'name.required' => 'Tên danh mục không được để trống',
            'name.unique' => 'Dữ liệu bị trùng',
            'name.max' => 'Độ dài tối đa 255 kí tự',
            'image.required' => 'Yêu cầu không được để trống',
            'image.mimes' => 'Không đúng định dạng ảnh',
//
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->parents_id = $request->input('parents_id');
        $category->slug = Str::slug($request->input('name'));
        if ($request->hasFile('image')) {
            // get file
            $file = $request->file('image');
            // get ten
            $filename = time() . '_' . $file->getClientOriginalName();
            // duong dan upload
            $path_upload = 'uploads/category/';
            // upload file
            $request->file('image')->move($path_upload, $filename);

            $category->image = $path_upload . $filename;
        }
        $is_active = 0;
        if ($request->has('is_active')) {//kiem tra is_active co ton tai khong?
            $is_active = $request->input('is_active');
        }
        $category->is_active = $is_active;
        $position = 0;
        if ($request->has('position')) {
            $position = $request->input('position');
        }
        $category->position = $position;

        $category->save();

        // chuyen dieu huong trang
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findorFail($id);
        return view('backend.category.show', ['data' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findorFail($id);
        return view('backend.category.edit',[
            'category'=>$category
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
            'new_image' => 'mimes:ipeg,jpg,png',
            'position' => 'required|integer|min:0',
            'is_active' => 'integer|min:0|max:1',
        ], [
            'name.required' => 'Tên danh mục không được để trống',
            'name.unique' => 'Dữ liệu bị trùng',
            'name.max' => 'Dộ dài tối đa 255 kí tự',
            'new_image.mimes' => 'Không đúng định dạng ảnh',
        ]);
        $category = Category::findorFail($id);; // khởi tạo model
        $category->name = $request->input('name');
        $category->parents_id = $request->input('parents_id');
        $category->slug = Str::slug($request->input('name'));
        if ($request->hasFile('new_image')) {
            // xóa file cũ
            @unlink(public_path($category->image));
            // get file mới
            $file = $request->file('new_image');
            // get tên
            $filename = time() . '_' . $file->getClientOriginalName();
            // duong dan upload
            $path_upload = 'uploads/category/';
            // upload file
            $request->file('new_image')->move($path_upload, $filename);

            $category->image = $path_upload . $filename;
        }
        $is_active = 0;
        if ($request->has('is_active')) {//kiem tra is_active co ton tai khong?
            $is_active = $request->input('is_active');
        }
        $category->is_active = $is_active;
        $position = 0;
        if ($request->has('position')) {
            $position = $request->input('position');
        }
        $category->position = $position;

        $category->save();

        // chuyen dieu huong trang
        return redirect()->route('category.index');
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
        $isDelete = Category::destroy($id);

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
