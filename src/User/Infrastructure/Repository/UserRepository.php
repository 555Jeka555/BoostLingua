<?php
declare(strict_types=1);

namespace App\User\Infrastructure\Repository;

use App\User\Domain\Entity\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class UserRepository implements UserRepositoryInterface
{
    private EntityRepository $repository;
    public function __construct(
        private EntityManagerInterface $entityManager,
    )
    {
        $this->repository = $this->entityManager->getRepository(User::class);
    }

    public function findById(int $userId): ?User
    {
        return $this->repository->findOneBy(['userId' => $userId]);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->repository->findOneBy(['email' => $email]);
    }

    public function findByLinkName(string $linkName): ?User
    {
        return $this->repository->findOneBy(['linkName' => $linkName]);
    }

    public function add(User $user): int
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user->getUserId();
    }

    public function update(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function remove(User $user): void
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}