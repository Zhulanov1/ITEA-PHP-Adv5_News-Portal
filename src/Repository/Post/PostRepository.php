<?php

declare(strict_types=1);

namespace App\Repository\Post;

use App\Model\Category;
use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method null|Post find($id, $lockMode = null, $lockVersion = null)
 * @method null|Post findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository implements PostRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function findById(int $id): ?Post
    {
        try {
            return $this->createQueryBuilder('p')
                ->where('p.id = :id')
                ->setParameter('id', $id)
                ->andWhere('p.publicationDate IS NOT NULL')
                ->innerJoin('p.category', 'c')
                ->addSelect('c')
                ->getQuery()
                ->getOneOrNullResult()
            ;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    public function findByCategory(Category $category): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.category = :category')
            ->setParameter('category', $category->getId())
            ->andWhere('p.publicationDate IS NOT NULL')
            ->getQuery()
            ->getResult()
            ;
    }
}
