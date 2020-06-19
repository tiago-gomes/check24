<?php

namespace App\Domain\Entity;

use App\Core\Traits\TimeRecordsTrait;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="post")
 */
class Post
{
    use TimeRecordsTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", unique=true)
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", nullable=true, length=254)
     * @Assert\NotBlank
     */
    protected $title;

    /**
     * @ORM\Column(nullable=true, type="text", length=65535)
     * @Assert\NotBlank
     */
    protected $description;
    
    /**
     * @ORM\Column(type="string", nullable=true, length=254)
     * @Assert\NotBlank
     */
    protected $author;
    
    /**
     *
     * Populate entity with data
     *
     * @param array $array
     * @return Post|null
     */
    public function populate(array $array): ?self
    {

        if (!empty($array['id']) ) {
            $this->setId($array['id']);
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
     * @return mixed
     */
    public function getId(): ?string
    {
        return $this->id;
    }
    
    /**
     * @return mixed
     */
    public function getAuthor(): string
    {
        return $this->author;
    }
    
    /**
     * @param $author
     * @return Post
     */
    public function setAuthor($author): self
    {
        $this->author = $author;
        return $this;
    }
    
    
    /**
     * @param $id
     * @return Post
     */
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getTitle(): string
    {
        return $this->title;
    }
    
    /**
     * @param $title
     * @return Post
     */
    public function setTitle($title): self
    {
        $this->title = $title;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getDescription(): string
    {
        return $this->description;
    }
    
    /**
     * @param $description
     * @return Post
     */
    public function setDescription($description): self
    {
        $this->description = $description;
        return $this;
    }
    
    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [
            'id'        => $this->getId(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'createdAt'    => $this->getCreatedAt()
        ];

        if (empty($this->getId())) {
            unset($array['id']);
        }

        return $array;
    }
}
