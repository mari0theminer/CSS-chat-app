<?php

namespace App\Entity;

use App\Repository\ChatRoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChatRoomRepository::class)
 */
class ChatRoom
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $hash;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Public;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Password;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="chatRooms")
     */
    private $Users;

    /**
     * @ORM\OneToMany(targetEntity=ChatMessage::class, mappedBy="ChatRoom")
     */
    private $chatMessages;

    public function __construct()
    {
        $this->Users = new ArrayCollection();
        $this->hash = bin2hex(random_bytes(16));
        $this->chatMessages = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getPublic(): ?bool
    {
        return $this->Public;
    }

    public function setPublic(bool $Public): self
    {
        $this->Public = $Public;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(?string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->Users;
    }

    public function addUser(User $user): self
    {
        if (!$this->Users->contains($user)) {
            $this->Users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->Users->removeElement($user);

        return $this;
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
            $chatMessage->setChatRoom($this);
        }

        return $this;
    }

    public function removeChatMessage(ChatMessage $chatMessage): self
    {
        if ($this->chatMessages->removeElement($chatMessage)) {
            // set the owning side to null (unless already changed)
            if ($chatMessage->getChatRoom() === $this) {
                $chatMessage->setChatRoom(null);
            }
        }

        return $this;
    }
}
