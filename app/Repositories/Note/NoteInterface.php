<?php

namespace App\Repositories\Note;

use App\Models\Note;

interface NoteInterface
{

    public function __construct(Note $note);

    public function store(array $data);
    public function getList();
    public function get($id);
    public function listByTitle(string $title);
    public function updateTitleById(int $id, string $title);
    public function updateContentById(int $id, string $content);
    public function delete(int $id);
}
