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
            'movement_type' => 'required|string|in:in,out',
            'qty' => 'required|integer|min:0',
            'reason' => 'nullable|string',
            'value' => 'required|integer|min:0'
        ]);
        return $validated;
    }
    public function uploadMoveRecord(Request $request, $id){
        DB::beginTransaction();
        try{
            $validated = $this->validateMoveRecord($request);
            $this->updateQuantity($id, $validated['qty'], $validated['movement_type']);
            $sparepartMovement = SparepartMovement::create([
                'sparepart_id' => $id,
                'movement_type' => $validated['movement_type'],
                'qty' => $validated['qty'],
                'reason' => $validated['reason'],
                'value' => $validated['value']
            ]);
            DB::commit();
            return redirect('/sparepart/movement')->with('status', 'Move record added!');
        }
        catch(\Exception $e){
            DB::rollBack();
            \Log::error('Fail to upload the move record'.$e->getMessage());
            return redirect('/sparepart/movement/upload/'.$id)->with('status', 'Failed to add Move record!');
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
    public function uploadMoveRecordForm($id){
        $sparepart = Sparepart::find($id);
        return view('uploadMoveRecord', ['sparepart' => $sparepart]);
    }
    public function viewMoveRecord(){
        $movements = SparepartMovement::all();
        return view('viewMoveRecord', ['movements' => $movements]);
    }
}
