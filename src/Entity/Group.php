<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupRepository")
 */
class Group
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
<<<<<<< HEAD
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="groups")
=======
     * @ORM\ManyToMany(targetEntity="App\Entity\user", inversedBy="groups")
>>>>>>> origin/Anthony
     */
    private $user_group;

    /**
     * @ORM\Column(type="integer")
     */
    private $group_game;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $membre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $icon;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Game", inversedBy="game_s")
     */
    private $gamegroup;

    public function __construct()
    {
        $this->user_group = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Collection|user[]
     */
    public function getUserGroup(): Collection
    {
        return $this->user_group;
    }

    public function addUserGroup(user $userGroup): self
    {
        if (!$this->user_group->contains($userGroup)) {
            $this->user_group[] = $userGroup;
        }

        return $this;
    }

    public function removeUserGroup(user $userGroup): self
    {
        if ($this->user_group->contains($userGroup)) {
            $this->user_group->removeElement($userGroup);
        }

        return $this;
    }

    public function getGroupGame(): ?int
    {
        return $this->group_game;
    }

    public function setGroupGame(int $group_game): self
    {
        $this->group_game = $group_game;

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

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): self
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

    public function getGamegroup(): ?Game
    {
        return $this->gamegroup;
    }

    public function setGamegroup(?Game $gamegroup): self
    {
        $this->gamegroup = $gamegroup;

        return $this;
    }
}
