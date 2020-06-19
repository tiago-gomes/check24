<?php

namespace App\Domain\Model\Repository;

use App\Domain\Entity\Comment;
use App\Domain\Model\Repository\DoctrineAwareInterface;
use App\Domain\Model\Repository\DoctrineAwareTrait;
use App\Domain\Model\Repository\Contract\CommentRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;


class CommentRepository implements CommentRepositoryInterface, DoctrineAwareInterface
{
    use DoctrineAwareTrait;

    /**
     * @inheritdoc
     */
    public function getAll(): ?array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('c')
            ->from(Comment::class, 'c');
        return $qb->getQuery()->getArrayResult();
    }

    /**
     * @inheritdoc
     */
    public function getById(string $id): ?Comment
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('c')
            ->from(Comment::class, 'c')
            ->where('c.id = :id')
            ->setMaxResults(1);

        $qb->setParameter('id', $id);

        return $qb->getQuery()->getOneOrNullResult();
    }
    
    /**
     * @inheritdoc
     */
    public function getAllByPostId(string $id): ?array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('c')
          ->from(Comment::class, 'c')
          ->where('c.postId = :id');
        
        $qb->setParameter('id', $id);
    
        return $qb->getQuery()->getArrayResult();
    }
    

    /**
     * @inheritdoc
     */
    public function create(Comment $comment, $flush = true): ?Comment
    {
        $this->getEntityManager()->persist($comment);

        if ($flush) {
            $this->flush();
        }

        return $comment;
    }

    /**
     * @inheritdoc
     */
    public function update(Comment $comment, $flush = true): ?Comment
    {

        $comment = $this->getEntityManager()->merge($comment);

        if ($flush) {
            $this->flush();
        }

        return $comment;
    }

    /**
     * @inheritdoc
     */
    public function remove(Comment $comment, $flush = true): bool
    {
        $this->getEntityManager()->remove($comment);

        if ($flush) {
            $this->flush();
        }

        return true;
    }
}
