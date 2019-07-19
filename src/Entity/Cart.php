<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CartRepository")
 */
class Cart
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="CartID", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $UserID;

    public function getID(): ?int
    {
        return $this->id;
    }


    public function getUserID(): ?User
    {
        return $this->UserID;
    }

    public function setUserID(User $UserID): self
    {
        $this->UserID = $UserID;

        return $this;
    }
}
