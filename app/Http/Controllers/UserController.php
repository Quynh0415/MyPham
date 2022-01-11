<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Category;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();

        return view('backend.user.index',[
            'user' => $user,
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
        $request->validate([
            'name' => 'required|max:255',
            //kiem tra input có name="name"
//            required: kiểm tra có bổ trống hay k, unique: kiểm tra trùng dữ liệu --tên bảng--tên cột, max: đọ dài tối đa
            'email'=>'required',
            'password'=>'required',
          //  'address'=>'required',
          //  'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
          //  'content' => 'required'

        ], [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
          //  'address.required' => 'Địa chỉ không được để trống',
           // 'phone.required' => 'Số điện thoại không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
           // 'content.required' => 'Nội dung không được để trống',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
     //   $user->phone = $request->input('phone');
        $user->password = bcrypt($request->input('password'));
        $user->address = $request->input('address');
       // $user->gender = $request->input('gender');

        $is_active = 1;
        if ($request->has('is_active')) { // kiem tra is_active co ton tai khong?
            $is_active = $request->input('is_active');
        }
        $user->is_active = $is_active;

        $user->save();

        return redirect()->back()->with('msg','Đăng ký thành công, bạn có thể đăng nhập tài khoản');
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
    public function edit()
    {
        $user = User::findOrFail(Auth::user()->id);
        $banner = Banner::where('is_active', '1')->orderBy('position')->get();
        $setting = Setting::first();
        $category = Category::where(['is_active' => 1])->where(['parents_id' => 0])->orderBy('position', 'ASC')->get();

        return view('frontend.user.infor_detail',[
            'user' => $user,
            'banner' => $banner,
            'setting' => $setting,
            'categories' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $banner = Banner::where('is_active', '1')->orderBy('position')->get();
        $setting = Setting::first();
        $category = Category::where(['is_active' => 1])->where(['parents_id' => 0])->orderBy('position', 'ASC')->get();

        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->gender = $request->input('gender');

        $is_active = 1;
        if ($request->has('is_active')) { // kiem tra is_active co ton tai khong?
            $is_active = $request->input('is_active');
        }
        $user->is_active = $is_active;

        // kiểm tra xem có nhập mật khẩu mới không ,, nếu có thì mới cập nhật
        if ($request->input('new_password')) {
            $user->password = bcrypt($request->input('new_password')); // mật khẩu mới
        }

        $user->save();

        return view('frontend.user.infor_detail',[
            'user' => $user,
            'banner' => $banner,
            'setting' => $setting,
            'categories' => $category,
        ]);

    }

    public function login()
    {
        return view('frontend.index');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('trangchu');
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
        $checkLogin = Auth::attempt($dataLogin, $request->has('remember'));
        // kiểm tra xem có đăng nhập thành côngh với email và password đã nhập hay không
        if ($checkLogin) {
            return redirect()->back();
        }

        return redirect()->back()->with('msg1', 'Email hoặc Password không chính xác');
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
        $isDelete = User::destroy($id); // return 1 | 0, true  false

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
