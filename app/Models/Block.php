<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'block_name',
        'description',
        'main_image',
    ];

    public function categories()
    {
        return $this->belongsTo(BlockCategory::class, 'category_id');
    }

    public function pageDetails()
    {
        return $this->hasMany(PageDetails::class);
    }
}
