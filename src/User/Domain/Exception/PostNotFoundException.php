<?php
declare(strict_types=1);

namespace App\User\Domain\Exception;

use App\Common\DomainException\DomainException;

class PostNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Post not found');
    }
}