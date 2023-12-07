<?php
declare(strict_types=1);

namespace App\Common\Transaction;

use Doctrine\ORM\EntityManagerInterface;

class Transaction implements TransactionInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    )
    {
    }

    /**
     * @throws \Throwable
     */
    public function execute(callable $callback): void
    {
        try {
            $this->entityManager->beginTransaction();
            $callback();
            $this->entityManager->commit();
        } catch (\Throwable $e) {
            $this->entityManager->rollback();
            throw $e;
        }
    }
}