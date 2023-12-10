<?php
declare(strict_types=1);

namespace App\User\Domain\Repository;

use App\User\Domain\Entity\Post;

interface PostRepositoryInterface extends PostReadRepositoryInterface
{
    public function add(Post $post): int;

    public function update(Post $post): void;

    public function remove(Post $post): void;
}