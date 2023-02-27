<?php

namespace App\Services\Note;

use App\Exceptions\DomainException;
use App\Models\Note;
use App\Repositories\Note\NoteInterface;
use App\Services\User\UserService;
use Spatie\QueryBuilder\QueryBuilder;

class NoteService
{

    private $noteRepository;
    private $userService;

    public function __construct(NoteInterface $noteRepository, UserService $userService)
    {
        $this->noteRepository = $noteRepository;
        $this->userService = $userService;
    }

    public function store(array $data)
    {
        $this->validateNote($data);

        $data["slug"] = $this->generateSlug($data["title"]);

        return $this->noteRepository->store($data);
    }

    public function getList()
    {
        $notes = QueryBuilder::for(Note::class)
            ->allowedFilters('title')
            ->get();

        return $notes;
    }

    public function get($id)
    {
        return $this->noteRepository->get($id);
    }

    public function getBySlug($slug)
    {
        return $this->noteRepository->getBySlug($slug);
    }

    public function listByTitle(string $title)
    {
        return $this->noteRepository->listByTitle($title);
    }

    public function listByUser(int $user_id)
    {
        if ($this->userService->get($user_id) == NULL) {
            throw new DomainException(["User not found"], 404);
        }

        return $this->noteRepository->listByUser($user_id);
    }

    public function updateTitleById(int $id, int $user_id, $title)
    {
        if ($this->get($id) == NULL) {
            throw new DomainException(["Note not found"], 404);
        }

        if (!$this->noteBelongsToUser($id, $user_id)) {
            throw new DomainException(["Note not found"], 404);
        }

        if ($title == NULL || empty($title) || strlen($title) > 255) {
            throw new DomainException(["Invalid title"], 400);
        }

        return $this->noteRepository->updateTitleById($id, $title);
    }

    public function updateContentById(int $id, int $user_id, $content)
    {
        if ($this->get($id) == NULL) {
            throw new DomainException(["Note not found"], 404);
        }

        if (!$this->noteBelongsToUser($id, $user_id)) {
            throw new DomainException(["Note not found"], 404);
        }

        if ($content == NULL || empty($content)) {
            throw new DomainException(["Invalid content"], 400);
        }

        return $this->noteRepository->updateContentById($id, $content);
    }

    public function delete($id, int $user_id)
    {
        if ($this->get($id) == NULL) {
            throw new DomainException(["Note not found"], 404);
        }

        if (!$this->noteBelongsToUser($id, $user_id)) {
            throw new DomainException(["Note not found"], 404);
        }

        return $this->noteRepository->delete($id);
    }

    public function validateNote(array $data)
    {
        $errors = [];
        if ($data["note_id"] != NULL && $this->get($data["note_id"]) == NULL) {
            // array_push($errors, "Note not found");
            throw new DomainException(["Note not found"], 404);
        }

        if ($this->userService->get($data["user_id"]) == NULL) {
            throw new DomainException(["User not found"], 404);
        }

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

    public function generateSlug(string $title)
    {
        return \Str::slug($title) . mb_substr(md5(microtime()), 0, 4);
    }

    public function noteBelongsToUser(int $id, int $user_id): bool
    {
        return $this->noteRepository->getByIdAndUserId($id, $user_id) != NULL;
    }
}
