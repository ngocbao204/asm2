<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $show = DB::table('products')->where('status','=','Còn hàng')->get();
        $banners = Banner::where('is_active', '=', 1)->get();
        // dd($banners);
        return view('user.home', compact('show', 'banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $detail = DB::table('products')->where('id', $id)->first();
        $show = DB::table('products')->get();
        // dd($detail);
        return view('user.detail', compact('detail','show'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
