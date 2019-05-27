<?php
declare(strict_types=1);

namespace App\Service\Post\Management;

use App\Entity\Post;
use App\Form\Dto\PostCreateDto;
use App\Mapper\PostMapper;
use App\Repository\Post\PostRepositoryInterface;

class PostManagementService implements PostManagementServiceInterface
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function create(PostCreateDto $dto): Post
    {
        $post = PostMapper::dtoToEntity($dto);

        $post->publish();

        $this->postRepository->save($post);

        return $post;
    }

    public function update(int $id, PostCreateDto $dto): void
    {
        $post = $this->postRepository->findById($id);

        $post
            ->setTitle($dto->title)
            ->setBody($dto->body)
            ->setShortDescription($dto->shortDescription)
            ->setCategory($dto->category)
            ->setImage($dto->image)
            ->update();

        $this->postRepository->update();
    }

    public function getDtoById(int $id): PostCreateDto
    {
        $post = $this->postRepository->findById($id);

        return PostMapper::entityToDto($post);
    }
}