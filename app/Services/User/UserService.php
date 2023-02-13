<?php

namespace App\Services\User;

use App\Exceptions\DomainException;
use App\Repositories\User\UserInterface;

class UserService
{

    private $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function store(array $data)
    {
        $this->validateUser($data);

        return $this->userRepository->store($data);
    }

    public function getList()
    {
        return $this->userRepository->getList();
    }

    public function get($id)
    {
        return $this->userRepository->get($id);
    }

    public function getByEmail($email)
    {
        return $this->userRepository->getByEmail($email);
    }

    public function update(array $data, int $id)
    {
        $errors = [];

        if ($this->get($id) == NULL) {
            throw new DomainException(["User not found"], 404);
        }

        if (!isset($data["name"]) || empty($data["name"]) || strlen($data["name"]) > 255) {
            array_push($errors, "Invalid name");
        }

        if (!empty($errors)) {
            throw new DomainException($errors, 400);
        }

        return $this->userRepository->update($data, $id);
    }

    public function delete($id)
    {
        if ($this->get($id) == NULL) {
            throw new DomainException(["User not found"], 404);
        }

        return $this->userRepository->delete($id);
    }

    public function validateUser(array $data)
    {
        $errors = [];

        if (!isset($data["name"]) || empty($data["name"]) || strlen($data["name"]) > 255) {
            array_push($errors, "Invalid name");
        }

        if ($this->getByEmail($data["email"]) != NULL) {
            array_push($errors, "Email is already in use");
        }

        if (empty($data["email"]) || strlen($data["email"]) > 255 || !filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Invalid e-mail");
        }

        if (!empty($errors)) {
            throw new DomainException($errors, 400);
        }
    }
}
