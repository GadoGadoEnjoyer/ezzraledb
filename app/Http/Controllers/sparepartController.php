<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sparepart;
use App\Models\SparepartType;
use Illuminate\Support\Facades\DB;

class sparepartController extends Controller
{
    public function validateSparepart(Request $request){
        try{
            $validated = $request->validate([
                'name' => 'required|string',
                'current_qty' => 'required|integer|min:0',
                'description' => 'nullable|string',
            ]);
            return $validated;
        }
        catch(\Exception $e){
            DB::rollBack();
            \Log::error('Fail to Validate the input with the following message'.$e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occured while validating the input of Spareparts']);
        }
    }
    public function uploadSparepart(Request $request){
        try{
            $validated = $this->validateSparepart($request);
            $sparepart = Sparepart::create([
                'name' => $validated['name'],
                'current_qty' => $validated['current_qty'],
                'description' => $validated['description']
            ]);
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
        return view('viewSparepartDetail', ['sparepart' => $sparepart]);
    }

    public function validateType(Request $request){
        try{
            $validated = $request->validate([
                'name' => 'required|string',
            ]);
            return $validated;
        }
        catch(\Exception $e){
            DB::rollBack();
            \Log::error('Fail to Validate the new Sparepart type'.$e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occured while validating this type']);
        }
    }
    public function uploadType(){
        try{
            $validated = $this->validateType($request);
            $sparepartType = SparepartType::create([
                'name' => $validated['name'],
            ]);
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
        try{
            $validated = $request->validate([
                'sparepart_id' => 'required|exists:spareparts,id',
                'sparepart_type_id' => 'required|array',
                'sparepart_type_id.*' => 'integer|exists:sparepart_types,id'
            ]);
            return $validated;
        }
        catch(\Exception $e){
            DB::rollBack();
            \Log::error('Fail to validate the type assignment'.$e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occured while assigning types']);
        }
    }
    public function assignType(Request $request){
        try{
            $validated = $this->validateAssignType($request);
            SparepartSparepartType::where('sparepart_id', $validated['sparepart_id'])->delete();
            foreach ($validated['sparepart_type_id'] as $typeId) {
                SparepartSparepartType::create([
                    'sparepart_id' => $validated['sparepart_id'],
                    'sparepart_type_id' => $typeId
                ]);
            }
        }
        catch(\Exception $e){
            DB::rollBack();
            \Log::error('Fail to assign type'.$e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occured while assigning types']);
        }
    }
}
