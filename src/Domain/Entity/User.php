<?php

namespace App\Domain\Entity;

use App\Core\Traits\TimeRecordsTrait;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
{
    use TimeRecordsTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", unique=true)
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", nullable=true, length=35)
     * @Assert\NotBlank
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", nullable=true, length=35)
     * @Assert\NotBlank
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string", unique=true, length=75)
     * @Assert\NotBlank
     */
    protected $email;
    
    /**
     * @ORM\Column(type="string", unique=true, length=75)
     * @Assert\NotBlank
     */
    protected $password;
    
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
    
        if (!empty($array['firstName']) ) {
            $this->setFirstName($array['firstName']);
        }
    
        if (!empty($array['lastName']) ) {
            $this->setLastName($array['lastName']);
        }
    
        if (!empty($array['email']) ) {
            $this->setEmail($array['email']);
        }
    
        if (!empty($array['password']) ) {
            $this->setPassword($array['password']);
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
     * @param $id
     * @return User
     */
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }
    
    /**
     * @param $firstName
     * @return User
     */
    public function setFirstName($firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }
    
    /**
     * @param $lastName
     * @return User
     */
    public function setLastName($lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getEmail(): string
    {
        return $this->email;
    }
    
    /**
     * @param $email
     * @return User
     */
    public function setEmail($email): self
    {
        $this->email = $email;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getPassword(): string
    {
        return $this->password;
    }
    
    /**
     * @param $password
     * @return User
     */
    public function setPassword($password): self
    {
        $this->password = $password;
        return $this;
    }
    
    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [
            'id'        => $this->getId(),
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'createdAt'    => $this->getCreatedAt()
        ];

        if (empty($this->getId())) {
            unset($array['id']);
        }

        return $array;
    }
}
