<?php
declare(strict_types=1);

namespace App\User\Domain\Service\InputData;

interface AddPostInputInterface
{
    public function getSubscribeId(): ?int;

    public function getAuthorId(): int;

    public function getTitle(): string;

    public function getBody(): string;

    public function getCover(): ?string;
}