<?php

namespace App\Repositories\Note;

use App\Models\Note;

interface NoteInterface {

    public function __construct(Note $note);

    public function store(array $data);
    public function getList();
    public function get($id);

}