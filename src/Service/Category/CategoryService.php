<?php

declare(strict_types=1);

namespace App\Service\Category;

use App\Mapper\CategoryMapper;
use App\Model\Category;
use App\Repository\Category\CategoryRepositoryInterface;
use App\Repository\Post\PostRepositoryInterface;

final class CategoryService implements CategoryServiceInterface
{
    private $categoryRepository;

    private $postRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository, PostRepositoryInterface $postRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->postRepository = $postRepository;
    }

    public function getCategory(string $slug): ?Category
    {
        $entity = $this->categoryRepository->findBySlug($slug);

        if (null === $entity) {
            return null;
        }

        $model = CategoryMapper::entityToModel($entity);

        return $model;
    }
}
