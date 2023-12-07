<?php
declare(strict_types=1);

namespace App\User\Domain\Service\InputData;

interface RegisterUserInputInterface
{
    public function getFirstName(): string;

    public function getSecondName(): string;

    public function getDescription(): ?string;

    public function getEmail(): string;

    public function getPassword(): string;

    public function getAvatarName(): ?string;
}