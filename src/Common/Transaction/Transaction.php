<?php
declare(strict_types=1);

namespace App\Common\Transaction;

use Doctrine\ORM\EntityManager;

class Transaction implements TransactionInterface
{
    public function __construct(
        private EntityManager $entityManager,
    )
    {
    }

    public function execute($callback): void
    {
        try {
            $this->entityManager->beginTransaction();
            $callback();

            $this->entityManager->commit();
        } catch (\Throwable) {
            $this->entityManager->rollback();
        }
    }
}