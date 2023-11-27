<?php
declare(strict_types=1);

namespace App\User\Domain\Repository;

use App\User\Domain\Entity\User;

interface UserReadRepositoryInterface
{
    public function findById(int $userId): ?User;

    public function findByEmail(string $email): ?User;

    public function findByLinkName(string $linkName): ?User;
}