<?php

namespace App\Repositories\Note;

use App\Models\Note;
use App\Repositories\Note\NoteInterface;

class NoteRepositoryEloquent implements NoteInterface
{

    protected $note;

    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    public function store(array $data)
    {
        return $this->note->create($data);
    }

    public function getList()
    {
        return $this->note->all();
    }

    public function get($id)
    {
        return $this->note->find($id);
    }
    
}