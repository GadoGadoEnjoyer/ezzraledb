<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SparepartSparepartType extends Model
{
    protected $table = 'sparepart_sparepart_types';

    protected $fillable = ['sparepart_id','sparepart_type_id'];
}
