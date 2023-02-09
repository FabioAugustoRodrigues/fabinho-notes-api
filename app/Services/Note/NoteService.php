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

    public function updateTitleById(int $id, $title)
    {
        if ($this->get($id) == NULL){
            throw new DomainException(["Note not found"], 404);
        }

        if ($title == NULL || empty($title) || strlen($title) > 255) {
            throw new DomainException(["Invalid title"], 400);
        }

        return $this->noteRepository->updateTitleById($id, $title);
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