<?php
declare(strict_types=1);

namespace App\Common\Transaction;

interface TransactionInterface
{
    public function execute($callback): void;
}