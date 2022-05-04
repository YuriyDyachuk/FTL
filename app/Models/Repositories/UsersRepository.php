<?php

namespace App\Models\Repositories;

use App\User;
use Illuminate\Database\Eloquent\Collection;

class UsersRepository
{
    public function create(array $validated):User
    {
        $validated['password'] = \Hash::make($validated['password']);
        $model = new User();
        $model->fill($validated)->save();
        return $model;
    }

    public function delete(int $id):void
    {
        $model = $this->findById($id);
        $model->delete();
    }

    public function update(User $model, array $validatedData):User
    {
        $model->update($validatedData);
        return $model;
    }

    public function findById(int $id):?User
    {
        return User::findOrFail($id);
    }

    public function getAll()
    {
        return User::paginate(env('ITEMS_PER_PAGE'));
    }
}
