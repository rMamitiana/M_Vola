<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=10, unique=true)
     * @Assert\NotBlank
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $money;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank
     */
    private $password;

    /**
     * @ORM\Column(type="date")
     *  @Assert\NotBlank
     */
    private $birthday;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $roles = [];


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getMoney(): ?float
    {
        return $this->money;
    }

    public function setMoney(?float $money): self
    {
        $this->money = $money;

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function setRoles(?array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * return the firstname and the lastname
     */
    public function getfullName()
    {
        return $this->firstname . $this->lastname;
    }

    /**
     * UserInterface function
     * @return string[]
     */
    public function getRoles()
    {
        return array_merge($this->roles, ['ROLE_USER']);
    }

    /**
     * @return string
     *
     * @deprecated since Symfony 5.3, use getUserIdentifier() instead
     */
    public function getUsername()
    {
    }

    /**
     * UserInterface function
     * @return string|null The salt
     */
    public function getSalt()
    {
    }


    /**
     * UserInterface function
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
    }

    /**
     * UserInterface function
     * @return string|null The hashed password if any
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * UserInterface function
     * @return string|null
     */
    public function getUserIdentifier()
    {
        return $this->getPhoneNumber();
    }
}
