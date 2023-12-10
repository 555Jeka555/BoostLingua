<?php
declare(strict_types=1);

namespace App\User\Domain\Repository;

use App\User\Domain\Entity\Post;

interface PostReadRepositoryInterface
{
    public function findById(int $postId): ?Post;

    /**
     * @return Post[]
     */
    public function findAll(): array;
}