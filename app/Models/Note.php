<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'note_id',
        'slug',
        'title',
        'content'
    ];

    public function notes()
    {
        return $this->hasMany(Note::class, 'note_id');
    }

    public function childNotes()
    {
        return $this->hasMany(Note::class, 'note_id')->with('notes');
    }
}
