<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameuserRepository")
 */
class Gameuser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\game", inversedBy="gameusers")
     */
    private $gameuser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user")
     */
    private $userid;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $badge;

    /**
     * @ORM\Column(type="decimal", precision=2, scale=0)
     */
    private $level;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $characterplayed;

    /**
     * @ORM\Column(type="decimal", precision=2, scale=0)
     */
    private $mmr;

    public function getId()
    {
        return $this->id;
    }

    public function getGameuser(): ?game
    {
        return $this->gameuser;
    }

    public function setGameuser(?game $gameuser): self
    {
        $this->gameuser = $gameuser;

        return $this;
    }

    public function getUserid(): ?user
    {
        return $this->userid;
    }

    public function setUserid(?user $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    public function getBadge(): ?string
    {
        return $this->badge;
    }

    public function setBadge(string $badge): self
    {
        $this->badge = $badge;

        return $this;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function setLevel($level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getCharacterplayed(): ?string
    {
        return $this->characterplayed;
    }

    public function setCharacterplayed(string $characterplayed): self
    {
        $this->characterplayed = $characterplayed;

        return $this;
    }

    public function getMmr()
    {
        return $this->mmr;
    }

    public function setMmr($mmr): self
    {
        $this->mmr = $mmr;

        return $this;
    }
}
