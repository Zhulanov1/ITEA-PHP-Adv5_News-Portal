<?php

declare(strict_types=1);

namespace App\Service\Post;

use App\Collection\PostCollection;
use App\Model\Category;
use App\Mapper\PostMapper;
use App\Model\Post;
use App\Repository\Post\PostRepositoryInterface;

final class PostPresentationService implements PostPresentationServiceInterface
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getPost(int $id): ?Post
    {
        $entity = $this->postRepository->findById($id);

        if (null === $entity) {
            return null;
        }

        $model = PostMapper::entityToModel($entity);

        return $model;
    }

    public function getPosts(Category $category): ?PostCollection
    {
        $posts = $this->postRepository->findByCategory($category);

        if (empty($posts)) {
            return null;
        }

        $postCollection = new PostCollection();

        foreach ($posts as $post) {
            $postCollection->addPost(PostMapper::entityToModel($post));
        }

        return $postCollection;
    }
}
