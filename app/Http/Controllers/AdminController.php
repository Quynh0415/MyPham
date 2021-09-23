<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Category;
use App\Product;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Admin::all();

        return view('backend.admin.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('backend.admin.create', ['roles' => $roles]);
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
            'name' => 'required|unique:users,name|max:255',
            //kiem tra input có name="name"
//            required: kiểm tra có bổ trống hay k, unique: kiểm tra trùng dữ liệu --tên bảng--tên cột, max: đọ dài tối đa
            'avatar' => 'required|mimes:ipeg,jpg,png',
            //exit kiểm tra dữ liệu có tồn tại trong bảng categories cột id hay k

            'role_id' => 'required|exists:roles,id',
            'is_active' => 'integer|min:0|max:1',
            'email'=>'required|unique:users,email',
            'password'=>'required',
        ], [
            'name.required' => 'Tên người dùng không được để trống',
            'name.unique' => 'Dữ liệu bị trùng',
            'name.max' => 'Độ dài tối đa 255 kí tự',
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Dữ liệu bị trùng',
            'avatar.required' => 'Yêu cầu không được để trống',
            'avatar.mimes' => 'Không đúng định dạng ảnh',
            'password.required'=>'Mật khẩu không được để trống',
            'role_id.required'=>'Bạn chưa phân quyền',

        ]);

        //luu vao csdl
        $admin = new Admin();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->password = bcrypt($request->input('password'));
        $admin->role_id = $request->input('role_id');

        if ($request->hasFile('avatar')) {
            // get file
            $file = $request->file('avatar');
            // get ten
            $filename = time().'_'.$file->getClientOriginalName();
            // duong dan upload
            $path_upload = 'uploads/admin/';
            // upload file
            $request->file('avatar')->move($path_upload,$filename);

            $admin->avatar = $path_upload.$filename;
        }

        $is_active = 0;
        if ($request->has('is_active')) { // kiem tra is_active co ton tai khong?
            $is_active = $request->input('is_active');
        }

        $admin->is_active = $is_active;
        $admin->save();

        //chuyen dieu huong trang
        return redirect()->route('admins.index');
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
        $admin = Admin::findOrFail($id);
        $role = Role::all();

        return view('backend.admin.edit',['admin' => $admin, 'roles' => $role]);
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
            'name' => 'required|unique:users,name|max:255',
            //kiem tra input có name="name"
//            required: kiểm tra có bổ trống hay k, unique: kiểm tra trùng dữ liệu --tên bảng--tên cột, max: đọ dài tối đa
            'avatar' => 'required|mimes:jpeg,jpg,png',
            //exit kiểm tra dữ liệu có tồn tại trong bảng categories cột id hay k

            'role_id' => 'required|exists:roles,id',
            'is_active' => 'integer|min:0|max:1',
            'email'=>'required|unique:users,email',
            'password'=>'required',
        ], [
            'name.required' => 'Tên người dùng không được để trống',
            'name.unique' => 'Dữ liệu bị trùng',
            'name.max' => 'Độ dài tối đa 255 kí tự',
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Dữ liệu bị trùng',
            'avatar.required' => 'Yêu cầu không được để trống',
            'avatar.mimes' => 'Không đúng định dạng ảnh',
            'password.required'=>'Mật khẩu không được để trống',
            'role_id.required'=>'Bạn chưa phân quyền',

        ]);
        $admin = Admin::findOrFail($id);
        $admin->name = $request->input('name'); // họ tên
        $admin->email = $request->input('email'); // email
        $admin->role_id = $request->input('role_id'); // phần quyền
        // kiểm tra xem có nhập mật khẩu mới không ,, nếu có thì mới cập nhật
        if ($request->input('new_password')) {
            $admin->password = bcrypt($request->input('new_password')); // mật khẩu mới
        }

        if ($request->hasFile('new_avatar')) {
            // xóa file cũ
            @unlink(public_path($admin->avatar)); // hàm unlink của PHP không phải laravel , chúng ta thêm @ đằng trước tránh bị lỗi
            // get file
            $file = $request->file('new_avatar');
            // get ten
            $filename = time().'_'.$file->getClientOriginalName();
            // duong dan upload
            $path_upload = 'uploads/admin/';
            // upload file
            $file->move($path_upload,$filename);
            $admin->avatar = $path_upload.$filename;
        }

        $is_active = 0;
        if ($request->has('is_active')) { // kiem tra is_active co ton tai khong?
            $is_active = $request->input('is_active');
        }
        $admin->is_active = $is_active;
        $admin->save();

        // chuyen dieu huong trang
        return redirect()->route('admins.index');
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
        $isDelete = Admin::destroy($id);

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

    // Trang đăng nhập
    public function login()
    {
        return view('backend.login.index');
    }

    public function logout(){
        Auth::logout();

        return redirect()->route('admin.login');
    }

    public function postLogin(Request $request)
    {
        //validate dữ liệu
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6'
        ]); // validate false => tạo ra biến $errors để toàn thông tin bị lỗi cho từng trường


        // validate thành công

        $dataLogin = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        //hàm xác thực login của framework : Auth::attemp();
        $checkLogin = Auth::guard('admin')->attempt($dataLogin, $request->has('remember'));

        // kiểm tra xem có đăng nhập thành côngh với email và password đã nhập hay không
        if ($checkLogin) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('msg', 'Email hoặc Password không chính xác');;
    }




}


