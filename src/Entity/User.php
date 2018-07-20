<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;


    /**
     * @ORM\Column(type="text")
     */
    private $message;

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
    private $groups;

    
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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

   

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
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
    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function addGroup(Group $group): self
    {
        if (!$this->groups->contains($group)) {
            $this->groups[] = $group;
            $group->addUserGroup($this);
        }

        return $this;
    }

    public function removeGroup(Group $group): self
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
     * Get the value of groups
     */ 
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Set the value of groups
     *
     * @return  self
     */ 
    public function setGroups($groups)
    {
        $this->groups = $groups;

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
     * Get the value of messages
     */ 
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Set the value of messages
     *
     * @return  self
     */ 
    public function setMessages($messages)
    {
        $this->messages = $messages;

        return $this;
    }
}
