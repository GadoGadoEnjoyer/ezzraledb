<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sparepart;
use App\Models\SparepartMovement;
use Illuminate\Support\Facades\DB;

class movementController extends Controller
{
    public function validateMoveRecord(Request $request){
        $validated = $request->validate([
            'sparepart_id' => 'required|exists:spareparts,id',
            'movement_type' => 'required|string|in:in,out',
            'qty' => 'required|integer|min:0',
            'reason' => 'nullable|string',
            'value' => 'required|integer|min:0'
        ]);
        return $validated;
    }
    public function uploadMoveRecord(Request $request){
        DB::beginTransaction();
        try{
            $validated = $this->validateMoveRecord($request);
            $this->updateQuantity($validated['sparepart_id'], $validated['qty'], $validated['movement_type']);
            $sparepartMovement = SparepartMovement::create([
                'sparepart_id' => $validated['sparepart_id'],
                'movement_type' => $validated['movement_type'],
                'qty' => $validated['qty'],
                'reason' => $validated['reason'],
                'value' => $validated['value']
            ]);

            DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
            \Log::error('Fail to upload the move record'.$e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occured while inputting move record']);
        }
    }
    public function updateQuantity($sparepart_id,$qty,$movement_type){
        try{
            $sparepart = Sparepart::find($sparepart_id);
            if ($movement_type == 'out') {
                $qty = $qty * -1;
            }
            $new_qty = $sparepart->current_qty + $qty;
            if ($new_qty < 0) {
                throw new \Exception('Quantity cannot be negative');
            }
            else{
                $sparepart->current_qty = $new_qty;
                $sparepart->save();
            }
        }
        catch(\Exception $e){
            \Log::error('Fail to update the quantity'.$e->getMessage());
            throw $e;
        }
    }
    public function uploadMoveRecordForm(){
        $spareparts = Sparepart::all();
        return view('uploadMoveRecord', ['spareparts' => $spareparts]);
    }
}
