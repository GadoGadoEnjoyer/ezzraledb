<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sparepart;
use App\Models\SparepartType;
use App\Models\SparepartSparepartType;
use Illuminate\Support\Facades\DB;

class sparepartController extends Controller
{
    public function validateSparepart(Request $request){
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|string'
        ]);
        return $validated;
    }
    public function uploadSparepart(Request $request){
        DB::beginTransaction();
        try{
            $validated = $this->validateSparepart($request);
            $sparepart = Sparepart::create([
                'name' => $validated['name'],
                'current_qty' => 0,
                'description' => $validated['description'],
                'status' => $validated['status']
            ]);
            DB::commit();
            return redirect()->route('viewSparepart')->with('status', 'Sparepart uploaded!');
        }

        catch(\Exception $e){
            DB::rollBack();
            \Log::error('Fail to upload the input with the following message'.$e->getMessage());
            return redirect()->route('uploadSparepartForm')->with('status', 'Failed to upload sparepart');
        }
    }
    public function uploadSparepartForm(){
        return view('uploadSparePart');
    }
    public function viewSparepart(Request $request){
        $query = $request->input('query');
        if ($query) {
            $spareparts = Sparepart::where('name', 'LIKE', '%' . $query . '%')->paginate(20);
        } else {
            $spareparts = Sparepart::paginate(10);
        }
        return view('viewSparepart', ['spareparts' => $spareparts]);
    }
    public function editSparepartForm($id){
        $sparepart = Sparepart::find($id);
        return view('editSparepart', ['sparepart' => $sparepart]);
    }
    public function editSparepart($id){
        DB::beginTransaction();
        try{
            $sparepart = Sparepart::find($id);
            $sparepart->name = request('name');
            $sparepart->description = request('description');
            $sparepart->status = request('status');
            $sparepart->save();
            DB::commit();
            return redirect()->route('viewSparepartDetail',$id)->with('status', 'Sparepart edited!');
        }
        catch(\Exception $e){
            DB::rollBack();
            \Log::error('Fail to edit the input with the following message'.$e->getMessage());
            return redirect()->route('editSparepartForm', $id)->with('status', 'Failed to edit sparepart');
        }
    }
    public function viewSparepartDetail($id){
        $sparepart = Sparepart::find($id);
        $images = $sparepart->images;
        return view('viewSparepartDetail', ['sparepart' => $sparepart, 'images' => $images]);
    }
}
