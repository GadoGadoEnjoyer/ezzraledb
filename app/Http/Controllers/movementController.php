<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sparepart;
use App\Models\SparepartMovement;
use Illuminate\Support\Facades\DB;

class movementController extends Controller
{
    public function validateMoveRecord(Request $request){
        try{
            $validated = $request->validate([
                'sparepart_id' => 'required|exists:spareparts,id',
                'movement_type' => 'required|string|in:in,out',
                'qty' => 'required|integer|min:0',
                'reason' => 'nullable|string',
                'value' => 'required|integer|min:0'
            ]);
            return $validated;
        }
        catch(\Exception $e){
            DB::rollBack();
            \Log::error('Fail to Validate the input with the following message'.$e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occured while validating the input of move record']);
        }
    }
    public function uploadMoveRecord(){
        try{
            $validated = $this->validateMoveRecord($request);
            $sparepartMovement = SparepartMovement::create([
                'sparepart_id' => $validated['sparepart_id'],
                'movement_type' => $validated['movement_type'],
                'qty' => $validated['qty'],
                'reason' => $validated['reason'],
                'value' => $validated['value']
            ]);
        }
        catch(\Exception $e){
            DB::rollBack();
            \Log::error('Fail to upload the move record'.$e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occured while inputting move record']);
        }
    }
}
