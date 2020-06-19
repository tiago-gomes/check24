<?php

namespace App\Domain\Model;

use \Exception;
use App\Domain\Entity\Comment;
use App\Domain\Model\Repository\Contract\PostRepositoryInterface;
use App\Domain\AbstractDomain;

/**
 * Class PostModel
 * @package App\Domain\Model
 */
class PostModel extends AbstractDomain
{
    
    /**
     * @return array|null
     * @throws Exception
     */
    public function getAll(): ?array
    {
        try{
            return $this->container->get(PostRepositoryInterface::class)->getAll();
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException($e->getMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    
    /**
     * @param int $id
     * @return Comment
     * @throws Exception
     */
    public function getPostById(int $id): Comment
    {
        try{
            if (empty($id)) {
                throw new Exception('Post ID can not be empty');
            }
            if (!$post = $this->container->get(PostRepositoryInterface::class)->getById($id)) {
                throw new \Exception('Post ID does not exist');
            }
            return $post;
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException($e->getMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    
    /**
     * @param $array
     * @return Comment
     * @throws Exception
     */
    public function addPost($array): Comment
    {
        try{
            $post    = new Comment($array);
            $post->setCreatedAt(date('Y-m-d G:i:s'));
            return $this->container->get(PostRepositoryInterface::class)->create($post);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param string $id
     * @param $array
     * @return Comment
     * @throws Exception
     */
    public function updatePost(string $id, $array):  Comment
    {
        try{
            if (!$post = $this->container->get(PostRepositoryInterface::class)->getById($id)) {
                throw new Exception('Post not found!');
            }
            $post->populate($array);
            $post->setUpdatedAt(date('Y-m-d'));
            return $this->container->get(PostRepositoryInterface::class)->update($post);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function removePost(int $id): bool
    {
        try{
            $post = $this->container->get(PostRepositoryInterface::class)->getById($id);
            return $this->container->get(PostRepositoryInterface::class)->remove($post);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
