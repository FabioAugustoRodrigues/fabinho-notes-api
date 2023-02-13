<?php

namespace App\Repositories\User;

use App\Models\User;

interface UserInterface
{

    public function __construct(User $note);

    public function store(array $data);
    public function update(array $data, int $id);
    public function getList();
    public function get($id);
    public function getByEmail(string $email);
    public function delete(int $id);
}
