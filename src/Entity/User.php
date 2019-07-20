<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
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
     */
    private $FirstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LastName;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Cart", mappedBy="UserID", cascade={"persist", "remove"})
     */
    private $CartID;


    # Security info
    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $Username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $HashedPassword;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Salt;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $IsActive;

    public function __construct()
    {
        $this->Salt = random_int(0, 999999);
        $this->IsActive = false;
    }



    public function getID(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getCartID(): ?Cart
    {
        return $this->CartID;
    }

    # Security info

    public function getUsername()
    {
        return $this->Username;
    }

    public function getHashedPassword()
    {
        return $this->HashedPassword;
    }

    public function setHashedPassword(string $unhashedPassword)
    {
        $this->HashedPassword = $unhashedPassword;
    }

    public function getPassword()
    {
        return $this->HashedPassword;
    }

    public function setPassword(string $unhashedPassword)
    {
        $this->HashedPassword = $unhashedPassword;
    }

    public function getSalt()
    {
        return $this->Salt;
    }

    public function getRoles()
    {
        return array('CLIENT_USER');
    }

    public function eraseCredentials()
    {
    }



    public function setCartID(Cart $CartID): self
    {
        $this->CartID = $CartID;

        // set the owning side of the relation if necessary
        if ($this !== $CartID->getUserID()) {
            $CartID->setUserID($this);
        }

        return $this;
    }




}
