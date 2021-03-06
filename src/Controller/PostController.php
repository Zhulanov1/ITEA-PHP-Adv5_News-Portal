<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Post\PostPresentationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PostController extends AbstractController
{
    /**
     * Renders post page.
     *
     * @param int $id
     * @param PostPresentationServiceInterface $postPresentation
     *
     * @return Response
     *
     * @Route("/post/{id}", name="post_view", requirements={"id": "\d+"})
     */
    public function view(int $id, PostPresentationServiceInterface $postPresentation): Response
    {
        $post = $postPresentation->getPost($id);

        if (null === $post) {
            throw $this->createNotFoundException('Post not found');
        }

        return $this->render('post/view.html.twig', [
            'post' => $post,
        ]);
    }
}
