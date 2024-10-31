<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SparepartMovement extends Model
{
    protected $table = 'sparepart_movements';

    public function sparepart() {
        return $this->belongsTo(Sparepart::class);
    }
}
