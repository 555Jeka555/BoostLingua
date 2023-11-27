<?php
declare(strict_types=1);

namespace App\User\Infrastructure\Converter;

use App\User\App\Query\Data\UserData;
use App\User\Domain\Entity\User;
use App\User\Domain\Entity\UserRole;

class UserConverter
{
    public static function createUserData(User $user): UserData
    {
        return new UserData(
            $user->getUserId(),
            $user->getFirstName(),
            $user->getSecondName(),
            $user->getLinkName(),
            $user->getDescription(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getAvatarName(),
            UserRole::getTypeByNumber($user->getRole()),
        );
    }
}