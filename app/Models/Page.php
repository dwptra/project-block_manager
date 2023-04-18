<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'page_name',
        'note',
        'status'
    ];


    public function projects()
    {
        return $this->belongsTo(Project::class, 'project');
    }
}
