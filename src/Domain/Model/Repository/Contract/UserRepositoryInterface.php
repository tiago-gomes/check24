<?php

namespace App\Domain\Model\Repository\Contract;

use App\Domain\Entity\User;
use phpDocumentor\Reflection\Types\Boolean;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;

/**
 * Interface UserRepositoryInterface
 * @package App\Domain\Model\Repository\Contract
 */
interface UserRepositoryInterface
{
    /**
     * @return User|null
     */
    public function getAll(): ?array;
    
    /**
     * @param string $id
     * @return array
     */
    public function getById(string $id): ?User;
    
    /**
     * @param User $user
     * @param bool $flush
     * @return User|null
     */
    public function create(User $user, $flush = false): ?User;

    /**
     * @param User $user
     * @return User|null
     */
    public function update(User $user, $flush = false): ?User;

    /**
     * @param bool $flush
     * @param User$user
     * @return bool
     */
    public function remove(User $user, $flush = false): bool;
}
