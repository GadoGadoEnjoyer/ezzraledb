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
                'description' => $validated['description']
            ]);
            DB::commit();
        }

        catch(\Exception $e){
            DB::rollBack();
            \Log::error('Fail to upload the input with the following message'.$e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occured while inputting Spareparts']);
        }
    }
    public function uploadSparepartForm(){
        return view('uploadSparePart');
    }
    public function viewSparepart(){
        $spareparts = Sparepart::all();
        return view('viewSparepart', ['spareparts' => $spareparts]);
    }
    public function viewSparepartDetail($id){
        $sparepart = Sparepart::find($id);
        $images = $sparepart->images;
        return view('viewSparepartDetail', ['sparepart' => $sparepart, 'images' => $images]);
    }

    public function validateType(Request $request){
        $validated = $request->validate([
            'name' => 'required|string',
        ]);
        return $validated;
    }
    public function uploadType(Request $request){
        DB::beginTransaction();
        try{
            $validated = $this->validateType($request);
            $sparepartType = SparepartType::create([
                'name' => $validated['name'],
            ]);
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
            \Log::error('Fail to upload the input with the following message'.$e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occured while inputting Spareparts']);
        }
    }
    public function uploadTypeForm(){
        return view('uploadType');
    }

    public function validateAssignType(Request $request){
        $validated = $request->validate([
            'types' => 'required|array',
            'types.*' => 'integer|exists:sparepart_types,id'
        ]);
        return $validated;
    }
    public function assignType(Request $request, $id){
        try{
            DB::beginTransaction();
            $validated = $this->validateAssignType($request);
            SparepartSparepartType::where('sparepart_id', $id)->delete();
            foreach ($validated['types'] as $typeId) {
                SparepartSparepartType::create([
                    'sparepart_id' => $id,
                    'sparepart_type_id' => $typeId
                ]);
            }
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
            \Log::error('Fail to assign type'.$e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occured while assigning types']);
        }
    }
    public function assignTypeForm($id){
        $sparepart = Sparepart::find($id);
        $sparepartTypes = SparepartType::all();
        return view('assignType', ['sparepart' => $sparepart, 'sparepartTypes' => $sparepartTypes]);
    }
}
