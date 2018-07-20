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
     * @ORM\ManyToMany(targetEntity="User", mappedBy="myFriends")
     */
    private $friendsWithMe;

    /**
     * Many Users have many Users.
     * @ORM\ManyToMany(targetEntity="User", inversedBy="friendsWithMe")
     * @ORM\JoinTable(name="friends",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="friend_user_id", referencedColumnName="id")}
     *      )
     */
    private $myFriends;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="user")
     */
    private $messages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="user")
     */
    private $usermessages;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Group", mappedBy="user_group")
     */
    private $groupes;

    
    public function __construct()
    {
        $this->friendsWithMe = new \Doctrine\Common\Collections\ArrayCollection();
        $this->myFriends = new \Doctrine\Common\Collections\ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->groups = new ArrayCollection();
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
     * @return Collection|Group[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Group $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
            $groupe->addUserGroup($this);
        }

        return $this;
    }

    public function removeGroupe(Group $group): self
    {
        if ($this->groups->contains($group)) {
            $this->groups->removeElement($group);
            $group->removeUserGroup($this);
        }

        return $this;
    }

    /**
     * Get many Users have Many Users.
     */ 
    public function getFriendsWithMe()
    {
        return $this->friendsWithMe;
    }

    /**
     * Set many Users have Many Users.
     *
     * @return  self
     */ 
    public function setFriendsWithMe($friendsWithMe)
    {
        $this->friendsWithMe = $friendsWithMe;

        return $this;
    }

    /**
     * Get many Users have many Users.
     */ 
    public function getMyFriends()
    {
        return $this->myFriends;
    }

    /**
     * Set many Users have many Users.
     *
     * @return  self
     */ 
    public function setMyFriends($myFriends)
    {
        $this->myFriends = $myFriends;

        return $this;
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
