<?php

namespace App\Repositories\Note;

use App\Models\Note;
use App\Repositories\Note\NoteInterface;

class NoteRepository implements NoteInterface
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

    public function listByTitle(string $title)
    {
        return $this->note->where('title', 'like', '%' . $title . '%')->get();
    }

    public function updateTitleById(int $id, string $title)
    {
        return $this->note->where('id', $id)->update(['title' => $title]) == 1;
    }

    public function updateContentById(int $id, string $content)
    {
        return $this->note->where('id', $id)->update(['content' => $content]) == 1;
    }
}
