<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Entity\Category;
use App\Model\Category as CategoryModel;

final class CategoryMapper
{
    public static function entityToModel(Category $entity): CategoryModel
    {
        $model = new CategoryModel(
            $entity->getId(),
            $entity->getTitle(),
            $entity->getSlug()
        );

        return $model;
    }
}
