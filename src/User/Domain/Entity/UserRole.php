<?php
declare(strict_types=1);

namespace App\User\Domain\Entity;

enum UserRole
{
    case ADMIN;
    case USER;

    public static function getTypeByNumber(int $role): UserRole
    {
        return match ($role) {
            1 => UserRole::ADMIN,
            2 => UserRole::USER,
        };
    }

    public static function getNumberByType(UserRole $role): int
    {
        return match ($role) {
            UserRole::ADMIN => 1,
            UserRole::USER => 2,
        };
    }
}
