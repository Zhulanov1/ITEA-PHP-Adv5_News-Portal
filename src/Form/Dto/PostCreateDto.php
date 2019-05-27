<?php
declare(strict_types=1);

namespace App\Form\Dto;

use App\Entity\Category;
use App\Entity\Post;

final class PostCreateDto
{
    public $title;
    public $body;
    public $shortDescription;
    public $category;
    public $image;
    public $publish;

    public function __construct(
        string $title = null,
        string $body = null,
        string $shortDescription = null,
        Category $category = null,
        string $image = null,
        bool $publish = null
    )
    {
        $this->title = $title;
        $this->body = $body;
        $this->shortDescription = $shortDescription;
        $this->category = $category;
        $this->image = $image;
        $this->publish = $publish;
    }
}