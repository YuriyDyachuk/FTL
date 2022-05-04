<?php


namespace App\Models\Services;

use App\Http\Requests\UsersRequest;
use App\Models\Repositories\UsersRepository;
use App\User;

class UsersService
{
    private $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function create(UsersRequest $request):User
    {
        return $this->usersRepository->create($request->validated());
    }

    public function findById(int $id)
    {
        return $this->usersRepository->findById($id);
    }

    public function delete(int $id)
    {
        $this->usersRepository->delete($id);
    }

    public function update(int $id, array $validatedData):User
    {
        $model = $this->findById($id);
        if(empty($validatedData['password'])){
            $validatedData['password'] = $model->password;
        }
        return $this->usersRepository->update($model, $validatedData);
    }

    public function getAll()
    {
        return $this->usersRepository->getAll();
    }
}
