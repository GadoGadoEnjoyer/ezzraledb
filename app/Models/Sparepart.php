<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sparepart extends Model
{
    protected $table = 'spareparts';

    public function types(){
        return $this->belongsToMany(SparepartType::class, 'sparepart_sparepart_types');
    }
    public function movements(){
        return $this->hasMany(SparepartMovement::class);
    }
    public function images()
    {
        return $this->belongsToMany(Image::class, 'sparepart_images', 'sparepart_id', 'image_id');
    }



    protected $fillable = ['name','current_qty','description','status'];
}
