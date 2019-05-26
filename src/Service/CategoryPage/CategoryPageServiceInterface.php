<?php
declare(strict_types=1);

namespace App\Service\CategoryPage;

use App\Collection\PostCollection;
use App\Model\Category;

interface CategoryPageServiceInterface
{
    public function getCategory(string $slug): Category;

    public function getPosts(Category $category): ?PostCollection;
}