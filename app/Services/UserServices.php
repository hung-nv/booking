<?php

namespace App\Services;


use App\Models\User;

class UserServices
{
    /**
     * Update account information.
     * @param $data
     * @return User|User[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function updateAccountInformation($data)
    {
        $user = User::find(\Auth::user()->id);

        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return $user;
    }

    /**
     * Get all users.
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllUsers()
    {
        $users = User::where('id', '<>', \Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();

        return $users;
    }

    /**
     * Create user.
     * @param $data
     * @return User|\Illuminate\Database\Eloquent\Model
     */
    public function createUser($data)
    {
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return $user;
    }

    /**
     * Get user by id.
     * @param $idUser
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function getUserById($idUser)
    {
        return User::findOrFail($idUser);
    }

    /**
     * Update user by id.
     * @param $data
     * @param $idUser
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function updateUserById($data, $idUser)
    {
        $user = User::findOrFail($idUser);

        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return $user;
    }

    /**
     * Delete user.
     * @param $idUser
     * @throws \Exception
     */
    public function deleteUserById($idUser)
    {
        $user = User::findOrFail($idUser);

        $user->delete();
    }
}