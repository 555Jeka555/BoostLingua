<?php
declare(strict_types=1);

namespace App\User\App\Service;

use App\Common\Transaction\TransactionInterface;
use App\User\Domain\Service\InputData\AddPostInputInterface;
use App\User\Domain\Service\PostService;

class PostAppService
{
    public function __construct(
        private PostService          $postService,
        private TransactionInterface $transaction,
    )
    {
    }

    public function createPost(AddPostInputInterface $input): int
    {
        $postId = null;
        $callback = function () use($input, &$postId): void {
            $postId = $this->postService->createPost($input);
        };

        $this->transaction->execute($callback);
        return $postId;
    }

    public function deletePost(int $postId): void
    {
        $callback = function () use($postId): void {
            $this->deletePost($postId);
        };

        $this->transaction->execute($callback);
    }
}