<?php

namespace App\Entity;

use App\Repository\PlaylistRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistRepository::class)]
class Playlist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTimeInterface $updatedAt;

    #[ORM\ManyToOne(inversedBy: 'playlist')]
    #[ORM\JoinColumn(nullable: false)]
    private PlaylistMedia $playlistMedia;

    #[ORM\ManyToOne(inversedBy: 'playlist')]
    #[ORM\JoinColumn(nullable: false)]
    private PlaylistSubscription $playlistSubscription;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getPlaylistMedia(): PlaylistMedia
    {
        return $this->playlistMedia;
    }

    public function setPlaylistMedia(PlaylistMedia $playlistMedia): static
    {
        $this->playlistMedia = $playlistMedia;

        return $this;
    }

    public function getPlaylistSubscription(): PlaylistSubscription
    {
        return $this->playlistSubscription;
    }

    public function setPlaylistSubscription(PlaylistSubscription $playlistSubscription): static
    {
        $this->playlistSubscription = $playlistSubscription;

        return $this;
    }
}
