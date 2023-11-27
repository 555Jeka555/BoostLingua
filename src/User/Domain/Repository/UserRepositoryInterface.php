<?php
declare(strict_types=1);

namespace App\User\Domain\Repository;

use App\User\Domain\Entity\User;

interface UserRepositoryInterface extends UserReadRepositoryInterface
{
    public function add(User $user): int;

    public function update(User $user): void;

    public function remove(User $user): void;
}