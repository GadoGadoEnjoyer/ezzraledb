<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SparepartImage extends Model
{
    protected $table = 'sparepart_images';

    protected $fillable = ['sparepart_id','image_id'];
}
