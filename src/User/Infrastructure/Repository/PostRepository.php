<?php
declare(strict_types=1);

namespace App\User\Infrastructure\Repository;

use App\User\Domain\Entity\Post;
use App\User\Domain\Repository\PostRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class PostRepository implements PostRepositoryInterface
{
    private EntityRepository $repository;

    public function __construct(
        private EntityManagerInterface $entityManager,
    )
    {
        $this->repository = $this->entityManager->getRepository(Post::class);
    }

    public function findById(int $postId): ?Post
    {
        return $this->repository->findOneBy(['postId' => $postId]);
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function add(Post $post): int
    {
        $this->entityManager->persist($post);
        $this->entityManager->flush();
        return $post->getPostId();
    }

    public function update(Post $post): void
    {
        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }

    public function remove(Post $post): void
    {
        $this->entityManager->remove($post);
        $this->entityManager->flush();
    }

    public function findByAuthorId(int $authorId): array
    {
        return $this->repository->findBy(['authorId' => $authorId]);
    }
}