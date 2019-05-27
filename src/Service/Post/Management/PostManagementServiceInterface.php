<?php
declare(strict_types=1);

namespace App\Service\Post\Management;

use App\Form\Dto\PostCreateDto;
use App\Entity\Post;

interface PostManagementServiceInterface
{
    public function create(PostCreateDto $dto): Post;

    public function getDtoById(int $id): PostCreateDto;

    public function update(int $id, PostCreateDto $dto): void;
}
