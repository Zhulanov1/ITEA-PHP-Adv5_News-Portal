<?php

declare(strict_types=1);

namespace App\Repository\Category;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CategoryRepository extends ServiceEntityRepository implements CategoryRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function findBySlug(string $slug): ?Category
    {
        try {
            return $this->createQueryBuilder('c')
                ->where('c.slug = :slug')
                ->setParameter('slug', $slug)
                ->getQuery()
                ->getOneOrNullResult()
                ;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}
