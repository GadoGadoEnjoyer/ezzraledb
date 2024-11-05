<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    public function spareparts()
    {
        return $this->belongsToMany(Sparepart::class, 'sparepart_images', 'image_id', 'sparepart_id');
    }

    protected $fillable = ['image_path','alt_text'];
}
