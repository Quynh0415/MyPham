<?php

namespace App\Http\Controllers;

use App\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $policy = Policy::all();

        return view('backend.policy.index',[
            'policy' =>$policy,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.policy.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $policy = new Policy();
        $policy->name = $request->input('name');
        $policy->content = $request->input('content');

        $policy->save();

        return redirect()->route('admin.policy.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $policy = Policy::findOrFail($id);

        return view('backend.brand.show',[
            'policy' => $policy,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $policy = Policy::findOrfail($id);

        return view('backend.policy.edit',[
            'policy' => $policy,
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
        $policy = Policy::findOrFail($id);
        $policy->name = $request->input('name');
        $policy->content = $request->input('content');

        $policy->save();

        return redirect()->route('admin.policy.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //g???i t???i h??m destroy c???a laravel ????? x??a 1 object
        // DELETE FROM ten_bang WHERE id = 33 -> execute command
        $isDelete = Policy::destroy($id);

        if ($isDelete) { // x??a th??nh c??ng
            $statusCode = 200;
            $isSuccess = true;
        } else {
            $statusCode = 400;
            $isSuccess = false;
        }

        // Tr??? v??? d??? li???u json v?? tr???ng th??i k??m theo th??nh c??ng l?? 200
        return response()->json(['isSuccess' => $isSuccess], $statusCode);

    }
}
