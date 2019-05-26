<?php

declare(strict_types=1);

namespace App\Service\Category;

use App\Model\Category;

interface CategoryServiceInterface
{
    public function getCategory(string $slug): ?Category;
}
