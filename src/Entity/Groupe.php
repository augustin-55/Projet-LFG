<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupeRepository")
 */
class Groupe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\user", inversedBy="groupes")
     */
    private $user_groupe;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="Image", cascade="all")
     */
    private $icon;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Game", inversedBy="game_s")
     */
    private $gamegroupe;

    public function __construct()
    {
        $this->user_groupe = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Collection|user[]
     */
    public function getUserGroupe(): Collection
    {
        return $this->user_groupe;
    }

    public function addUserGroupe(user $userGroupe): self
    {
        if (!$this->user_groupe->contains($userGroupe)) {
            $this->user_groupe[] = $userGroupe;
        }

        return $this;
    }

    public function removeUserGroupe(user $userGroupe): self
    {
        if ($this->user_groupe->contains($userGroupe)) {
            $this->user_groupe->removeElement($userGroupe);
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMembre(): ?string
    {
        return $this->membre;
    }

    public function setMembre(string $membre): self
    {
        $this->membre = $membre;

        return $this;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function setIcon(Image $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getGamegroupe(): ?Game
    {
        return $this->gamegroupe;
    }

    public function setGamegroupe(?Game $gamegroupe): self
    {
        $this->gamegroupe = $gamegroupe;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
}
