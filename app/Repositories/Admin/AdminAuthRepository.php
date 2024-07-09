<?php
namespace App\Repositories;

use App\Models\Admin;

class AdminAuthRepository implements AdminRepositoryInterface
{
    public function create(array $data): Admin
    {
        return Admin::create($data);
    }

    public function findByEmail(string $email): ?Admin
    {
        return Admin::where('email', $email)->first();
    }
}
