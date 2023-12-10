<?php
declare(strict_types=1);

namespace App\User\Domain\Entity;

class Post
{
    private ?int $postId = null;

    public function __construct(
        private ?int    $subscribeId,
        private int     $authorId,
        private string  $title,
        private string  $body,
        private ?string $cover,
    )
    {
    }

    public function getPostId(): ?int
    {
        return $this->postId;
    }

    public function getSubscribeId(): ?int
    {
        return $this->subscribeId;
    }

    public function setSubscribeId(?int $subscribeId): void
    {
        $this->subscribeId = $subscribeId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): void
    {
        $this->cover = $cover;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }
}