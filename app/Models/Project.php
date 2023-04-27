<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_name',
        'project_manager'
    ];

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function projectManager()
    {
        return $this->belongsTo(ProjectManager::class, 'project_manager');
    }
}
