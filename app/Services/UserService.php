<?php

namespace App\Services;

use App\Models\User;

/**
 * Class UserService.
 */
class UserService
{
    public function list()
    {
        return User::all();
    }

    public function create(mixed $params)
    {
        // TODO implementation
    }

    public function get(mixed $params)
    {
        // TODO implementation
    }

    public function update(mixed $params)
    {
        // TODO implementation
        return $params instanceof User ? $params->update() : "Not implemented yet";
    }

    public function delete(int $id)
    {
        return User::destroy($id);
    }
}
