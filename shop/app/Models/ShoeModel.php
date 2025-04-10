<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoeModel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'brand_id'];

    protected $table = 'models';

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}

