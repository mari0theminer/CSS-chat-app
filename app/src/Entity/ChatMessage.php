<?php

namespace App\Entity;

use App\Repository\ChatMessageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChatMessageRepository::class)
 */
class ChatMessage
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
    private $text;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="chatMessages")
     */
    private $Send_from;


    /**
     * @ORM\ManyToOne(targetEntity=ChatRoom::class, inversedBy="chatMessages")
     */
    private $ChatRoom;
    public function __construct()
    {
            $this->hash = bin2hex(random_bytes(16));

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }


    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getSendFrom(): ?User
    {
        return $this->Send_from;
    }

    public function setSendFrom(?User $Send_from): self
    {
        $this->Send_from = $Send_from;

        return $this;
    }



    public function getChatRoom(): ?ChatRoom
    {
        return $this->ChatRoom;
    }

    public function setChatRoom(?ChatRoom $ChatRoom): self
    {
        $this->ChatRoom = $ChatRoom;

        return $this;
    }
}
