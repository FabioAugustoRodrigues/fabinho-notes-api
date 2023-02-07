<?php

namespace App\Services\Note;

use App\Repositories\Note\NoteInterface;

class NoteService
{

    private $noteRepository;

    public function __construct(NoteInterface $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    public function store(array $data)
    {
        return $this->noteRepository->store($data);
    }

    public function getList()
    {
        return $this->noteRepository->getList();
    }

    public function get($id)
    {
        return $this->noteRepository->get($id);
    }
}