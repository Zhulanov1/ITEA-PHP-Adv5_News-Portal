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

    public function findById(int $id, array $params = []): ?Post
    {
        try {

            $qb = $this->createQueryBuilder('p')
                    ->where('p.id = :id')
                    ->setParameter('id', $id)
                    ->innerJoin('p.category', 'c')
                    ->addSelect('c');

            if (isset($params['post_status'])) {
                switch ($params['post_status']) {
                    case 'published':
                    $qb->andWhere('p.publicationDate IS NOT NULL');
                    break;

                    case 'pending':
                    $qb->andWhere('p.publicationDate IS NULL');
                    break;

                    //do nothing
                    case 'any': ;
                    break;
                }

            } else {
                $qb->andWhere('p.publicationDate IS NOT NULL');
            }

            return $qb->getQuery()
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

    public function save(Post $post): void
    {
        $em = $this->getEntityManager();
        $em->persist($post);
        $em->flush();
    }

    public function update(): void
    {
        $em = $this->getEntityManager();
        $em->flush();
    }
}
