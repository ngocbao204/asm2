<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listCategory = DB::table('categories')->get();
        return view('admin.category.listCategory', compact('listCategory'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
        return view('admin.category.createCategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::table('categories')->insert([
            'name_category' =>$request->name,
        ]);
        return redirect()->route('Category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_category)
    {
        $data =  DB::table('categories')->where('id',$id_category)->first();
        return view('admin.category.editCategory',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table('categories')->where('id',$id)->update([
            'name_category' =>$request->name
            
        ]);
        return redirect()->route('Category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_category)
    {
        DB::table('categories')->where('id',$id_category)->delete();
        return back();
    }
}
