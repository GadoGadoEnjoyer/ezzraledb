<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SparepartType extends Model
{
    protected $table = 'sparepart_types';
    public $timestamps = false;

    public function spareparts(){
        return $this->belongsToMany(Sparepart::class, 'sparepart_sparepart_types');
    }
    protected $fillable = ['name'];
}
