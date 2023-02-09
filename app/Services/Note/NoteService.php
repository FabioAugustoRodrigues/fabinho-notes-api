<?php

namespace App\Services\Note;

use App\Exceptions\DomainException;
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
        $this->validateNote($data);
        
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

    public function listByTitle(string $title)
    {
        return $this->noteRepository->listByTitle($title);
    }

    public function validateNote(array $data)
    {
        $errors = [];
        if (!isset($data["title"]) || empty($data["title"]) || strlen($data["title"]) > 255) {
            array_push($errors, "Invalid title");
        }

        if (!isset($data["content"]) || empty($data["content"])) {
            array_push($errors, "Invalid content");
        }

        if (!empty($errors)) {
            throw new DomainException($errors, 400);
        }
    }
}