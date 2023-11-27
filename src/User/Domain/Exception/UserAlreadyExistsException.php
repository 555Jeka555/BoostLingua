<?php
declare(strict_types=1);

namespace App\User\Domain\Exception;

use App\Common\DomainException\DomainException;

class UserAlreadyExistsException extends DomainException
{
    public function __construct()
    {
        parent::__construct('User already exists');
    }
}