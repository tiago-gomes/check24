<?php

namespace App\Domain\Model\Repository\Contract;

use App\Domain\Entity\Post;
use phpDocumentor\Reflection\Types\Boolean;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;

/**
 * Interface PostRepositoryInterface
 * @package App\Domain\Model\Repository\Contract
 */
interface PostRepositoryInterface
{
    /**
     * @return Post|null
     */
    public function getAll(): ?array;

    /**
     * @param string $id
     * @return Post|null
     */
    public function getById(string $id): ?Post;
    
    /**
     * @param Post $post
     * @return Post|null
     */
    public function create(Post $post, $flush = false): ?Post;

    /**
     * @param Post $post
     * @return Post|null
     */
    public function update(Post $post, $flush = false): ?Post;

    /**
     * @param bool $flush
     * @param Post$post
     * @return bool
     */
    public function remove(Post $post, $flush = false): bool;
}
