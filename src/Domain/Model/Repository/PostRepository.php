<?php

namespace App\Domain\Model\Repository;

use App\Domain\Entity\Post;
use App\Domain\Model\Repository\DoctrineAwareInterface;
use App\Domain\Model\Repository\DoctrineAwareTrait;
use App\Domain\Model\Repository\Contract\PostRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;


class PostRepository implements PostRepositoryInterface, DoctrineAwareInterface
{
    use DoctrineAwareTrait;

    /**
     * @inheritdoc
     */
    public function getAll(): ?array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('c')
            ->from(Post::class, 'c');
        return $qb->getQuery()->getArrayResult();
    }

    /**
     * @inheritdoc
     */
    public function getById(string $id): ?Post
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('c')
            ->from(Post::class, 'c')
            ->where('c.id = :id')
            ->setMaxResults(1);

        $qb->setParameter('id', $id);

        return $qb->getQuery()->getOneOrNullResult();
    }
    

    /**
     * @inheritdoc
     */
    public function create(Post $post, $flush = true): ?Post
    {
        $this->getEntityManager()->persist($post);

        if ($flush) {
            $this->flush();
        }

        return $post;
    }

    /**
     * @inheritdoc
     */
    public function update(Post $post, $flush = true): ?Post
    {

        $post = $this->getEntityManager()->merge($post);

        if ($flush) {
            $this->flush();
        }

        return $post;
    }

    /**
     * @inheritdoc
     */
    public function remove(Post $post, $flush = true): bool
    {
        $this->getEntityManager()->remove($post);

        if ($flush) {
            $this->flush();
        }

        return true;
    }
}
