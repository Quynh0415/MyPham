<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $coupon = Coupon::all();

        return view('backend.coupon.index', [
            'coupon' => $coupon,
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
        $coupon = Coupon::all();

        return view('backend.coupon.create', [
            'coupon' => $coupon,
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
        $coupon = new Coupon();
        $coupon->code = $request->input('code');
        $coupon->value = $request->input('value');
        $coupon->date_end = $request->input('date_end');
        $coupon->quantity = $request->input('quantity');
        $coupon->condition = $request->input('condition');

        if ($request->has('is_active')) { // kiem tra is_active co ton tai khong ?
            $is_active = $request->input('is_active');
        }
        $coupon->is_active = $is_active;

        $coupon->save();

        return redirect()->route('admin.coupon.index');
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
        $coupon = Coupon::find($id);

        return view('backend.coupon.edit', [
            'coupon' => $coupon,
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
        $coupon = Coupon::findOrFail($id);
        $coupon->code = $request->input('code');
        $coupon->value = $request->input('value');
        $coupon->date_end = $request->input('date_end');
        $coupon->quantity = $request->input('quantity');
        $coupon->condition = $request->input('condition');

        if ($request->has('is_active')) { // kiem tra is_active co ton tai khong ?
            $is_active = $request->input('is_active');
        }
        $coupon->is_active = $is_active;

        $coupon->save();

        return redirect()->route('admin.coupon.index');
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
        $isDelete = Coupon::destroy($id); // return 1 | 0, true  false

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
