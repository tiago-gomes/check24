<?php

namespace App\Domain\Model\Repository\Contract;

use App\Domain\Entity\Comment;
use phpDocumentor\Reflection\Types\Boolean;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;

interface CommentRepositoryInterface
{
    /**
     * @return Comment|null
     */
    public function getAll(): ?array;
    
    /**
     * @param string $id
     * @return Comment|null
     */
    public function getById(string $id): ?Comment;
    
    /**
     * @param string $id
     * @return array
     */
    public function getAllByPostId(string $id): ?array;
    
    /**
     * @param Comment $comment
     * @return Comment|null
     */
    public function create(Comment $comment, $flush = false): ?Comment;

    /**
     * @param Comment $comment
     * @return Comment|null
     */
    public function update(Comment $comment, $flush = false): ?Comment;

    /**
     * @param bool $flush
     * @param Comment$comment
     * @return bool
     */
    public function remove(Comment $comment, $flush = false): bool;
}
