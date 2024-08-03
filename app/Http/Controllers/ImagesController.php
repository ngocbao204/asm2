<?php

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();
        return view('user.layout.banner', compact('images'));
    }

    public function create()
    {
        return view('images.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('image')->store('images');

        Image::create([
            'title' => $request->title,
            'description' => $request->description,
            'path' => $path,
        ]);

        return redirect()->route('images.index')->with('success', 'Image uploaded successfully.');
    }

    public function edit(Image $image)
    {
        return view('images.edit', compact('image'));
    }

    public function update(Request $request, Image $image)
    {
        $request->validate([
            'title' => 'required',
        ]);

        if ($request->hasFile('image')) {
            Storage::delete($image->path);
            $path = $request->file('image')->store('images');
            $image->path = $path;
        }

        $image->title = $request->title;
        $image->description = $request->description;
        $image->save();

        return redirect()->route('images.index')->with('success', 'Image updated successfully.');
    }

    public function destroy(Image $image)
    {
        Storage::delete($image->path);
        $image->delete();
        return redirect()->route('images.index')->with('success', 'Image deleted successfully.');
    }
}

