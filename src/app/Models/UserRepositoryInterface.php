<?php

namespace App\Models;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): ?User;
}
