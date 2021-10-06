<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::all();

        return view('backend.banner.index', ['data' => $banner]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banner.create');
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
            'title' => 'required|unique:banners,title|max:255',
            //kiem tra input có name="name"
//            required: kiểm tra có bổ trống hay k, unique: kiểm tra trùng dữ liệu --tên bảng--tên cột, max: đọ dài tối đa
            'image' => 'required|mimes:ipeg,jpg,png',
            //exit kiểm tra dữ liệu có tồn tại trong bảng categories cột id hay k

           // 'position' => 'required|integer|min:0',
           // 'is_active' => 'integer|min:0|max:1',
        ], [
            'title.required' => 'Tên danh mục không được để trống',
            'title.unique' => 'Dữ liệu bị trùng',
            'title.max' => 'Độ dài tối đa 255 kí tự',
            'image.required' => 'Yêu cầu không được để trống',
            'image.mimes' => 'Không đúng định dạng ảnh',
        ]);

        $banner = new Banner();
        $banner->title = $request->input('title');
        if ($request->hasFile('image')) { // dòng này Kiểm tra xem có image có được chọn
            // get file
            $file = $request->file('image');
            // đặt tên cho file image
            $filename = time() . '_' . $file->getClientOriginalName(); // $file->getClientOriginalName() == tên ban đầu của image
            // Định nghĩa đường dẫn sẽ upload lên
            $path_upload = 'uploads/banner/'; // uploads/brand ; uploads/vendor
            // Thực hiện upload file
            $file->move($path_upload, $filename);

            // lưu lại cái tên
            $banner->image = $path_upload . $filename;
        }
        $banner->slug = Str::slug($request->input('title')); // slug
        $banner->url = $request->input('url');
        $banner->description = $request->input('description');
        $is_active = 0;
        if ($request->has('is_active')) { //kiem tra is_active co ton tai khong?
            $is_active = $request->input('is_active');
        }
        // trạn thái
        $banner->is_active = $is_active;
        $position = 0;
        if ($request->has('position')) {
            $position = $request->input('position');
        }
        $banner->position = $position;

        $banner->save();

        return redirect()->route('banner.index');

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
        $banner = Banner::findOrFail($id);

        return view('backend.banner.edit', ['banner' => $banner]);
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
            'title' => 'required|max:255|unique:banners,title,'.$id,
            //kiem tra input có name="name"
//            required: kiểm tra có bổ trống hay k, unique: kiểm tra trùng dữ liệu --tên bảng--tên cột, max: đọ dài tối đa
            'new_image' => 'mimes:ipeg,jpg,png',
            //exit kiểm tra dữ liệu có tồn tại trong bảng categories cột id hay k

            //'position' => 'required|integer|min:0',
           // 'is_active' => 'integer|min:0|max:1',
        ], [
            'title.required' => 'Tên Banner không được để trống',
            'title.unique' => 'Dữ liệu bị trùng',
            'title.max' => 'Độ dài tối đa 255 kí tự',
            'new_image.mimes' => 'Không đúng định dạng ảnh',
        ]);

        $banner = Banner::findOrFail($id);

        $banner->title = $request->input('title');
        if ($request->hasFile('new_image')) { // dòng này Kiểm tra xem ảnh mới có được chọn
            // xóa file cũ
            @unlink(public_path($banner->image)); // hàm unlink của PHP không phải laravel , chúng ta thêm @ đằng trước tránh bị lỗi
            // get new_image
            $file = $request->file('new_image');
            // đặt tên cho file new_image
            $filename = time() . '_' . $file->getClientOriginalName(); // $file->getClientOriginalName() == tên ban đầu của image
            // Định nghĩa đường dẫn sẽ upload lên
            $path_upload = 'uploads/banner/';
            // Thực hiện upload file
            $file->move($path_upload, $filename);

            $banner->image = $path_upload . $filename; // gán giá trị ảnh mới cho thuộc tính image của đối tượng
        }
        $banner->slug = Str::slug($request->input('title')); // slug
        $banner->url = $request->input('url');
        $banner->description = $request->input('description');
        $is_active = 0;
        if ($request->has('is_active')) { //kiem tra is_active co ton tai khong?
            $is_active = $request->input('is_active');
        }
        // trạn thái
        $banner->is_active = $is_active;
        $position = 0;
        if ($request->has('position')) {
            $position = $request->input('position');
        }
        $banner->position = $position;

        $banner->save();

        // Chuyển hướng trang về trang danh sách
        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //gọi tới hàm destroy của laravel để xóa 1 object
        // DELETE FROM ten_bang WHERE id = 33 -> execute command
        $isDelete = Banner::destroy($id);

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
