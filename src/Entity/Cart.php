<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CartRepository")
 */
class Cart
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $CartID;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="CartID", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $UserID;

    public function getCartID(): ?int
    {
        return $this->CartID;
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
