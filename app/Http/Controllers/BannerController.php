<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('image');
        if($request->has('image')) {
            $path = Storage::putFile('banners', $request->file('image'));
            $nameImage = 'storage/' . $path;

            $data['image'] = $nameImage;
        }

        Banner::query()->create($data);

        return redirect()->route('banners.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $data = $request->except('image');

        if($request->has('image')) {
            $path = Storage::putFile('banners', $request->file('image'));
            $nameImage = 'storage/' . $path;

            $data['image'] = $nameImage;

            if($banner->image && file_exists($banner->image)) {
                unlink($banner->image);
            }
        }else {
            $data['image'] = $banner->image;

        }

        $banner->update($data);

        return redirect()->route('banners.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        if($banner->image && file_exists($banner->image)){
            unlink($banner->image);
        }

        if($banner->delete()) {
        return redirect()->route('banners.index');
        }
    }
}
