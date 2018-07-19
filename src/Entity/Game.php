<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\group", mappedBy="gamegroup")
     */
    private $game_s;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Gameuser", mappedBy="gameuser")
     */
    private $gameusers;

    public function __construct()
    {
        $this->game_s = new ArrayCollection();
        $this->gameusers = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Collection|group[]
     */
    public function getGameS(): Collection
    {
        return $this->game_s;
    }

    public function addGame(group $game): self
    {
        if (!$this->game_s->contains($game)) {
            $this->game_s[] = $game;
            $game->setGamegroup($this);
        }

        return $this;
    }

    public function removeGame(group $game): self
    {
        if ($this->game_s->contains($game)) {
            $this->game_s->removeElement($game);
            // set the owning side to null (unless already changed)
            if ($game->getGamegroup() === $this) {
                $game->setGamegroup(null);
            }
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Gameuser[]
     */
    public function getGameusers(): Collection
    {
        return $this->gameusers;
    }

    public function addGameuser(Gameuser $gameuser): self
    {
        if (!$this->gameusers->contains($gameuser)) {
            $this->gameusers[] = $gameuser;
            $gameuser->setGameuser($this);
        }

        return $this;
    }

    public function removeGameuser(Gameuser $gameuser): self
    {
        if ($this->gameusers->contains($gameuser)) {
            $this->gameusers->removeElement($gameuser);
            // set the owning side to null (unless already changed)
            if ($gameuser->getGameuser() === $this) {
                $gameuser->setGameuser(null);
            }
        }

        return $this;
    }
}
