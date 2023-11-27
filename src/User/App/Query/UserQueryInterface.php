<?php
declare(strict_types=1);

namespace App\User\App\Query;

use App\User\App\Query\Data\UserData;

interface UserQueryInterface
{
    public function findByUserId(int $userId): UserData;

    public function findByEmail(string $email): UserData;

    public function findByLinkName(string $linkName): UserData;
}