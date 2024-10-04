<?php

namespace App\Entity;

use App\Repository\PlaylistSubscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistSubscriptionRepository::class)]
class PlaylistSubscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTimeInterface $suscribedAt;

    /**
     * @var Collection<int, Playlist>
     */
    #[ORM\OneToMany(targetEntity: Playlist::class, mappedBy: 'playlistSubscription')]
    private Collection $playlist;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'playlistSubscription')]
    private Collection $author;

    public function __construct()
    {
        $this->playlist = new ArrayCollection();
        $this->author = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSuscribedAt(): \DateTimeInterface
    {
        return $this->suscribedAt;
    }

    public function setSuscribedAt(\DateTimeInterface $suscribedAt): static
    {
        $this->suscribedAt = $suscribedAt;

        return $this;
    }

    /**
     * @return Collection<int, Playlist>
     */
    public function getPlaylist(): Collection
    {
        return $this->playlist;
    }

    public function addPlaylist(Playlist $playlist): static
    {
        if (!$this->playlist->contains($playlist)) {
            $this->playlist->add($playlist);
            $playlist->setPlaylistSubscription($this);
        }

        return $this;
    }

    public function removePlaylist(Playlist $playlist): static
    {
        if ($this->playlist->removeElement($playlist)) {
            // set the owning side to null (unless already changed)
            if ($playlist->getPlaylistSubscription() === $this) {
                $playlist->setPlaylistSubscription(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getAuthor(): Collection
    {
        return $this->author;
    }

    public function addAuthor(User $author): static
    {
        if (!$this->author->contains($author)) {
            $this->author->add($author);
            $author->setPlaylistSubscription($this);
        }

        return $this;
    }

    public function removeAuthor(User $author): static
    {
        if ($this->author->removeElement($author)) {
            // set the owning side to null (unless already changed)
            if ($author->getPlaylistSubscription() === $this) {
                $author->setPlaylistSubscription(null);
            }
        }

        return $this;
    }
}
