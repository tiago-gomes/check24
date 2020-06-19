<?php

namespace App\Domain\Model;

use \Exception;
use App\Domain\Entity\Comment;
use App\Domain\Model\Repository\Contract\CommentRepositoryInterface;
use App\Domain\AbstractDomain;

/**
 * Class CommentModel
 * @package App\Domain\Model
 */
class CommentModel extends AbstractDomain
{
    
    /**
     * @return array|null
     * @throws Exception
     */
    public function getAll(): ?array
    {
        try{
            return $this->container->get(CommentRepositoryInterface::class)->getAll();
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
    public function getAllByPostId(int $id): Comment
    {
        try{
            if (empty($id)) {
                throw new Exception('Comment ID can not be empty');
            }
            if (!$comment = $this->container->get(CommentRepositoryInterface::class)->getAllByPostId($id)) {
                throw new \Exception('Comment ID does not exist');
            }
            return $comment;
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
    public function addComment($array): Comment
    {
        try{
            $comment    = new Comment($array);
            $comment->setCreatedAt(date('Y-m-d G:i:s'));
            return $this->container->get(CommentRepositoryInterface::class)->create($comment);
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
    public function updateComment(string $id, $array):  Comment
    {
        try{
            if (!$comment = $this->container->get(CommentRepositoryInterface::class)->getById($id)) {
                throw new Exception('Comment not found!');
            }
            $comment->populate($array);
            $comment->setUpdatedAt(date('Y-m-d'));
            return $this->container->get(CommentRepositoryInterface::class)->update($comment);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function removeComment(int $id): bool
    {
        try{
            $comment = $this->container->get(CommentRepositoryInterface::class)->getById($id);
            return $this->container->get(CommentRepositoryInterface::class)->remove($comment);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
