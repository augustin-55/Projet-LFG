<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Image", cascade="all")
     */
    private $avatar;


    // /**
    //  * @ORM\OneToMany(targetEntity="App\Entity\Gameuser", mappedBy="user")
    //  */
    // private $gameUsers;

    /**
     * Many Users have Many Users.
     * @ORM\ManyToMany(targetEntity="User", inversedBy="friendFollowMe", cascade="all")
     * @ORM\JoinTable(name="friends",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="friend_user_id", referencedColumnName="id")}
     *      )
     */
    private $friendFollow;

    /**
     * Many Users have many Users.
     * @ORM\ManyToMany(targetEntity="User", mappedBy="friendFollow", cascade="all")
    
     */
    private $friendFollowMe;

    /**
     * Messages envoyées
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="user")
     */
    private $messages;

    /**
     * Messages reçus
     * @ORM\ManyToMany(targetEntity="App\Entity\Message", mappedBy="destinataires")
     */
    private $usermessages;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Groupe", mappedBy="user_groupe")
     */
    private $groupes;

    
    public function __construct()
    {
        $this->friendFollow = new \Doctrine\Common\Collections\ArrayCollection();
        $this->friendFollowMe = new \Doctrine\Common\Collections\ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->groupes = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setUserId($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getUserId() === $this) {
                $message->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
            $groupe->addUserGroupe($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->contains($groupe)) {
            $this->groupes->removeElement($groupe);
            $groupe->removeUserGroupe($this);
        }

        return $this;
    }

    /**
     * Get many Users have Many Users.
     */ 
    public function getfriendFollow()
    {
        return $this->friendFollow;
    }

    /**
     * Set many Users have Many Users.
     *
     * @return  self
     */ 
    public function setfriendFollow($friendFollow)
    {
        $this->friendFollow = $friendFollow;

        return $this;
    }

    /**
     * Get many Users have many Users.
     */ 
    public function getfriendFollowMe()
    {
        return $this->friendFollowMe;
    }

    /**
     * Set many Users have many Users.
     *
     * @return  self
     */ 
    public function setfriendFollowMe($friendFollowMe)
    {
        $this->friendFollowMe = $friendFollowMe;

        return $this;
    }

    public function addFollow(User $follow)
    {
        if (!$this->friendFollow->contains($follow)) {
            $this->friendFollow[] = $follow;
        }
    }

    public function removeFollow(User $follow)
    {
        if ($this->friendFollow->contains($follow)) {
            $this->friendFollow->removeElement($follow);
        }
    }

    public function hasFollow(User $follow)
    {
        return $this->friendFollow->contains($follow);
    }

    /**
     * Get the value of usermessages
     */ 
    public function getUsermessages()
    {
        return $this->usermessages;
    }

    /**
     * Set the value of usermessages
     *
     * @return  self
     */ 
    public function setUsermessages($usermessages)
    {
        $this->usermessages = $usermessages;

        return $this;
    }

    /**
     * Get the value of avatar
     */ 
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set the value of avatar
     *
     * @return  self
     */ 
    public function setAvatar(Image $avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }
}
