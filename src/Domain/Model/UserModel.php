<?php

namespace App\Domain\Model;

use \Exception;
use App\Domain\Entity\User;
use App\Domain\Model\Repository\Contract\UserRepositoryInterface;
use App\Domain\AbstractDomain;

/**
 * Class UserModel
 * @package App\Domain\Model
 */
class UserModel extends AbstractDomain
{
    
    /**
     * @return array|null
     * @throws Exception
     */
    public function getAll(): ?array
    {
        try{
            return $this->container->get(UserRepositoryInterface::class)->getAll();
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException($e->getMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    
    /**
     * @param int $id
     * @return User
     * @throws Exception
     */
    public function getUserById(int $id): User
    {
        try{
            if (empty($id)) {
                throw new Exception('User ID can not be empty');
            }
            if (!$user = $this->container->get(UserRepositoryInterface::class)->getById($id)) {
                throw new \Exception('User ID does not exist');
            }
            return $user;
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException($e->getMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    
    /**
     * @param $array
     * @return User
     * @throws Exception
     */
    public function addUser($array): User
    {
        try{
            $user    = new User($array);
            if ($userExists = $this->container->get(UserRepositoryInterface::class)->getByEmail($user->getEmail())) {
                throw new \Exception('An User already exists with the provided email!');
            }
            $user->setCreatedAt(date('Y-m-d G:i:s'));
            return $this->container->get(UserRepositoryInterface::class)->create($user);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param string $id
     * @param $array
     * @return User
     * @throws Exception
     */
    public function updateUser(string $id, $array):  User
    {
        try{
            if (!$user = $this->container->get(UserRepositoryInterface::class)->getById($id)) {
                throw new Exception('User not found!');
            }
            $user->populate($array);
            $user->setUpdatedAt(date('Y-m-d'));
            return $this->container->get(UserRepositoryInterface::class)->update($user);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function removeUser(int $id): bool
    {
        try{
            $user = $this->container->get(UserRepositoryInterface::class)->getById($id);
            return $this->container->get(UserRepositoryInterface::class)->remove($user);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
