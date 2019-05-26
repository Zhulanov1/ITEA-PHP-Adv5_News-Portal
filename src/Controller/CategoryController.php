<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\CategoryPage\CategoryPageServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CategoryController extends AbstractController
{
    /**
     * @param string $slug
     * @param CategoryPageServiceInterface $categoryService
     *
     * @return Response
     * @Route("/category/{slug}", name="category_view", requirements={"slug": "^[a-z0-9]+(?:-[a-z0-9]+)*$"})
     */
    public function view(string $slug, CategoryPageServiceInterface $categoryService): Response
    {
        $category = $categoryService->getCategory($slug);

        if (null === $category) {
            throw $this->createNotFoundException('Category not found');
        }

        $posts = $categoryService->getPosts($category);

        return $this->render(
            'category/view.html.twig',
            ['category' => $category,
             'posts' => $posts, ]
        );
    }
}
