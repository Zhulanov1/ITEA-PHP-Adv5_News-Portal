<?php

declare(strict_types=1);

namespace App\Repository\Post;

use App\Entity\Post;

interface PostRepositoryInterface
{
    public function findById(int $id): ?Post;

    public function findByCategoryId(int $category_id): array;
}
