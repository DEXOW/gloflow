<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class FileStore extends Controller
{
    static public function img_store(Request $request)
    {
        $request->validate([
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);

        if ($request->hasFile('image')) {
            $save_path = 'assets/images/products/';
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save($save_path . $filename );
            return response()->json(['path' => $save_path.$filename]);
        }
    }
}
