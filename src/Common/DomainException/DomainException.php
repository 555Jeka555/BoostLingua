<?php
declare(strict_types=1);

namespace App\Common\DomainException;

class DomainException extends \DomainException
{
    public function __construct(string $message = "")
    {
        parent::__construct($message);
    }
}