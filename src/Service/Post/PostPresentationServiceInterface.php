<?php

declare(strict_types=1);

namespace App\Service\Post;

use App\Collection\PostCollection;
use App\Model\Category;
use App\Model\Post;

interface PostPresentationServiceInterface
{
    public function getPost(int $id): ?Post;

    public function getPosts(Category $category): ?PostCollection;
}
