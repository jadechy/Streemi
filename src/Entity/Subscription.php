<?php

namespace App\Entity;

use App\Repository\SubscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubscriptionRepository::class)]
class Subscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 100)]
    private string $name;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private string $price;

    #[ORM\Column]
    private int $durationInMonths;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'currentSubscription')]
    private Collection $users;

    /**
     * @var Collection<int, SubscriptionHistory>
     */
    #[ORM\OneToMany(targetEntity: SubscriptionHistory::class, mappedBy: 'subscription')]
    private Collection $subscriptionHistories;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->subscriptionHistories = new ArrayCollection();
    }

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

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDurationInMonths(): int
    {
        return $this->durationInMonths;
    }

    public function setDurationInMonths(int $durationInMonths): static
    {
        $this->durationInMonths = $durationInMonths;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setCurrentSubscriptionId($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCurrentSubscriptionId() === $this) {
                $user->setCurrentSubscriptionId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SubscriptionHistory>
     */
    public function getSubscriptionHistories(): Collection
    {
        return $this->subscriptionHistories;
    }

    public function addSubscriptionHistory(SubscriptionHistory $subscriptionHistory): static
    {
        if (!$this->subscriptionHistories->contains($subscriptionHistory)) {
            $this->subscriptionHistories->add($subscriptionHistory);
            $subscriptionHistory->setSubscriptionId($this);
        }

        return $this;
    }

    public function removeSubscriptionHistory(SubscriptionHistory $subscriptionHistory): static
    {
        if ($this->subscriptionHistories->removeElement($subscriptionHistory)) {
            // set the owning side to null (unless already changed)
            if ($subscriptionHistory->getSubscriptionId() === $this) {
                $subscriptionHistory->setSubscriptionId(null);
            }
        }

        return $this;
    }
}
