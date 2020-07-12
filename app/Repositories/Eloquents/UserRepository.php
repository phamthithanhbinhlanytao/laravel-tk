<?php
namespace App\Repositories\Eloquents;

use App\Models\User;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }
}
