<?php

declare(strict_types=1);

namespace App\Repository\Post;

use App\Model\Category;
use App\Entity\Post;

interface PostRepositoryInterface
{
    public function findById(int $id): ?Post;

    public function findByCategory(Category $category): array;
}
