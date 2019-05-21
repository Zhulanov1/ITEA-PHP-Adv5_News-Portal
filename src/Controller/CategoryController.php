<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Category\CategoryServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CategoryController extends AbstractController
{
    /**
     * @param string $slug
     * @param CategoryServiceInterface $categoryService
     *
     * @return Response
     * @Route("/category/{slug}", name="category_view", requirements={"slug": "^[a-z]+$"})
     */
    public function view(string $slug, CategoryServiceInterface $categoryService): Response
    {
        $category = $categoryService->getCategory($slug);

        if (null === $category) {
            throw $this->createNotFoundException('Category not found');
        }

        $posts = $categoryService->getPosts($category->getId());

        return $this->render(
            'category/view.html.twig',
            ['category' => $category,
             'posts' => $posts, ]
        );
    }
}
