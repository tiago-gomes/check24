<?php

namespace App\Domain\Model\Repository;

use App\Domain\Entity\User;
use App\Domain\Model\Repository\DoctrineAwareInterface;
use App\Domain\Model\Repository\DoctrineAwareTrait;
use App\Domain\Model\Repository\Contract\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;


class UserRepository implements UserRepositoryInterface, DoctrineAwareInterface
{
    use DoctrineAwareTrait;

    /**
     * @inheritdoc
     */
    public function getAll(): ?array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('c')
            ->from(User::class, 'c');
        return $qb->getQuery()->getArrayResult();
    }

    /**
     * @inheritdoc
     */
    public function getById(string $id): ?User
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('c')
            ->from(User::class, 'c')
            ->where('c.id = :id')
            ->setMaxResults(1);

        $qb->setParameter('id', $id);

        return $qb->getQuery()->getOneOrNullResult();
    }
    
    /**
     * @inheritdoc
     */
    public function getByPostId(string $id): ?User
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('c')
          ->from(User::class, 'c')
          ->where('c.id = :id')
          ->setMaxResults(1);
        
        $qb->setParameter('id', $id);
        
        return $qb->getQuery()->getOneOrNullResult();
    }
    

    /**
     * @inheritdoc
     */
    public function create(User $comment, $flush = true): ?User
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
    public function update(User $comment, $flush = true): ?User
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
    public function remove(User $comment, $flush = true): bool
    {
        $this->getEntityManager()->remove($comment);

        if ($flush) {
            $this->flush();
        }

        return true;
    }
}
