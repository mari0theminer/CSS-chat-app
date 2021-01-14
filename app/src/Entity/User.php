<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
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
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\ManyToMany(targetEntity=ChatRoom::class, mappedBy="Users")
     */
    private $chatRooms;

    /**
     * @ORM\OneToMany(targetEntity=ChatMessage::class, mappedBy="Send_from")
     */
    private $chatMessages;

    /**
     * @ORM\OneToMany(targetEntity=ChatMessage::class, mappedBy="send_to")
     */
    private $ChatMessage_received;

    public function __construct()
    {
        $this->chatRooms = new ArrayCollection();
        $this->chatMessages = new ArrayCollection();
        $this->ChatMessage_received = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return Collection|ChatRoom[]
     */
    public function getChatRooms(): Collection
    {
        return $this->chatRooms;
    }

    public function addChatRoom(ChatRoom $chatRoom): self
    {
        if (!$this->chatRooms->contains($chatRoom)) {
            $this->chatRooms[] = $chatRoom;
            $chatRoom->addUser($this);
        }

        return $this;
    }

    public function removeChatRoom(ChatRoom $chatRoom): self
    {
        if ($this->chatRooms->removeElement($chatRoom)) {
            $chatRoom->removeUser($this);
        }

        return $this;
    }
    public function __toString()
    {
        return "".$this->username;
    }

    /**
     * @return Collection|ChatMessage[]
     */
    public function getChatMessages(): Collection
    {
        return $this->chatMessages;
    }

    public function addChatMessage(ChatMessage $chatMessage): self
    {
        if (!$this->chatMessages->contains($chatMessage)) {
            $this->chatMessages[] = $chatMessage;
            $chatMessage->setSendFrom($this);
        }

        return $this;
    }

    public function removeChatMessage(ChatMessage $chatMessage): self
    {
        if ($this->chatMessages->removeElement($chatMessage)) {
            // set the owning side to null (unless already changed)
            if ($chatMessage->getSendFrom() === $this) {
                $chatMessage->setSendFrom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ChatMessage[]
     */
    public function getChatMessageReceived(): Collection
    {
        return $this->ChatMessage_received;
    }

    public function addChatMessageReceived(ChatMessage $chatMessageReceived): self
    {
        if (!$this->ChatMessage_received->contains($chatMessageReceived)) {
            $this->ChatMessage_received[] = $chatMessageReceived;
            $chatMessageReceived->setSendTo($this);
        }

        return $this;
    }

    public function removeChatMessageReceived(ChatMessage $chatMessageReceived): self
    {
        if ($this->ChatMessage_received->removeElement($chatMessageReceived)) {
            // set the owning side to null (unless already changed)
            if ($chatMessageReceived->getSendTo() === $this) {
                $chatMessageReceived->setSendTo(null);
            }
        }

        return $this;
    }

}
