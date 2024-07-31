<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    use HasFactory;

    protected $fillable = ['section_id', 'title', 'details', 'image', 'status'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
