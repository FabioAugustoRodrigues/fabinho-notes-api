<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\User\UserInterface;

class UserRepository implements UserInterface
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function store(array $data)
    {
        return $this->user->create($data);
    }

    public function update(array $data, int $id)
    {
        return $this->user->where('id', $id)->update(['name' => $data['name']])==1;
    }

    public function getList()
    {
        return $this->user->all();
    }

    public function get($id)
    {
        return $this->user->find($id);
    }

    public function getByEmail($email)
    {
        return $this->user->where('email', $email)->first();
    }

    public function delete(int $id)
    {
        return $this->user->where('id', $id)->delete();
    }
}
