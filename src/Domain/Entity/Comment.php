<?php

namespace App\Domain\Entity;

use App\Core\Traits\TimeRecordsTrait;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="comment")
 */
class Comment
{
    use TimeRecordsTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", unique=true)
     */
    private $id;
    
    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private $postId;
    
    /**
     * @ORM\Column(type="string", nullable=true, length=35)
     * @Assert\NotBlank
     */
    protected $name;
    
    /**
     * @ORM\Column(type="string", unique=true, length=125)
     * @Assert\NotBlank
     */
    protected $url;
    
    /**
     * @ORM\Column(type="string", unique=true, length=255)
     * @Assert\NotBlank
     */
    protected $comment;
    
    /**
     *
     * Populate entity with data
     *
     * @param array $array
     * @return Comment|null
     */
    public function populate(array $array): ?self
    {
        
        if (!empty($array['id']) ) {
            $this->setId($array['id']);
        }
    
        if (!empty($array['postId']) ) {
            $this->setPostId($array['postId']);
        }
    
        if (!empty($array['name']) ) {
            $this->setName($array['name']);
        }
    
        if (!empty($array['comment']) ) {
            $this->setComment($array['comment']);
        }
    
        if (!empty($array['url']) ) {
            $this->setUrl($array['url']);
        }
        
        return $this;
    }

    /**
     * Account constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        return $this->populate($data);
    }
    
    /**
     * @return null|string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return Comment
     */
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPostId(): string
    {
        return $this->postId;
    }
    
    /**
     * @param $postId
     * @return Comment
     */
    public function setPostId($postId): self
    {
        $this->postId = $postId;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
    
    /**
     * @param $url
     * @return Comment
     */
    public function setUrl($url): self
    {
        $this->url = $url;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }
    
    /**
     * @param $comment
     * @return Comment
     */
    public function setComment($comment): self
    {
        $this->comment = $comment;
        return $this;
    }
    
    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [
            'id'        => $this->getId(),
            'post_id' => $this->getPostId(),
            'email' => $this->getName(),
            'url' => $this->getUrl(),
            'comment' => $this->getComment(),
            'createdAt'    => $this->getCreatedAt()
        ];

        if (empty($this->getId())) {
            unset($array['id']);
        }

        return $array;
    }
}
