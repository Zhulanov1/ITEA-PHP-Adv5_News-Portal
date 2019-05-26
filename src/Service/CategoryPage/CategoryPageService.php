<?php
declare(strict_types=1);

namespace App\Service\CategoryPage;

use App\Collection\PostCollection;
use App\Model\Category;
use App\Service\Category\CategoryServiceInterface;
use App\Service\Post\PostPresentationServiceInterface;

final class CategoryPageService implements CategoryPageServiceInterface
{
    private $categoryService;
    private $postService;

    public function __construct(
        CategoryServiceInterface $categoryService,
        PostPresentationServiceInterface $postService
    )
    {
        $this->categoryService = $categoryService;
        $this->postService = $postService;
    }

    public function getCategory(string $slug): Category
    {
        return $this->categoryService->getCategory($slug);
    }

    public function getPosts(Category $category): ?PostCollection
    {
        return $this->postService->getPosts($category);
    }
}