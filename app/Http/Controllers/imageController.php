<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\SparepartImage;
use App\Models\Sparepart;

class imageController extends Controller
{
    public function uploadImageForm($id){
        $sparepart = Sparepart::find($id);
        return view('uploadImage', ['sparepart' => $sparepart]);
    }
    public function uploadImage(Request $request , $id){
        $validated = $request->validate([
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'alt_text' => 'required'
        ]);
        $imageName = time().'.'.$validated['image_path']->extension();
        $validated['image_path']->move(public_path('images'), $imageName);
        $img = Image::create([
            'image_path' => $imageName,
            'alt_text' => $validated['alt_text']
        ]);

        SparepartImage::create([
            'sparepart_id' => $id,
            'image_id' => $img->id
        ]);
        return redirect('/image/upload');
    }
}
