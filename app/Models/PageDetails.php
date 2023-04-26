<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'page_id',
        'section_name',
        'block_id',
        'note',
        'sort'
    ];

    public function pages()
    {
        return $this->belongsTo(Page::class, 'page_id'); 
    }

    public function blocks()
    {
        return $this->belongsTo(Block::class, 'block_id'); 
    }
}
