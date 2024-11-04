<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\SparepartImage;
use App\Models\Sparepart;
use Illuminate\Support\Facades\DB;
class imageController extends Controller
{
    public function uploadImageForm($id){
        $sparepart = Sparepart::find($id);
        return view('uploadImage', ['sparepart' => $sparepart]);
    }
    public function uploadImage(Request $request , $id){
        DB::beginTransaction();
        try{
            $validated = $this->validateImage($request);
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
            DB::commit();
            return redirect()->route('viewSparepartDetail', ['id' => $id]);
        }
        catch(\Exception $e){
            DB::rollBack();
            \Log::error('Fail to upload the image with the following message'.$e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occured while uploading the image']);
        }
    }
    public function validateImage(Request $request){
        $validated = $request->validate([
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'alt_text' => 'required'
        ]);
        return $validated;
    }
}
