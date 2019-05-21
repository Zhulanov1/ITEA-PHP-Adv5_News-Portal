<?php

declare(strict_types=1);

namespace App\Service\Category;

use App\Mapper\CategoryMapper;
use App\Mapper\PostMapper;
use App\Model\Category;
use App\Repository\Category\CategoryRepositoryInterface;
use App\Repository\Post\PostRepositoryInterface;
use App\Collection\PostCollection;

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

    public function getPosts(int $category_id): ?PostCollection
    {
        $posts = $this->postRepository->findByCategoryId($category_id);

        if (0 === \count($posts)) {
            return null;
        }

        $postCollection = new PostCollection();

        foreach ($posts as $post) {
            $postCollection->addPost(PostMapper::entityToModel($post));
        }

        return $postCollection;
    }
}
