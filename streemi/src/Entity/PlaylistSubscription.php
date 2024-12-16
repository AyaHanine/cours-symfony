<?php

namespace App\Entity;

use App\Repository\PlaylistSubscriptionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistSubscriptionRepository::class)]
class PlaylistSubscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $subscriped_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubscripedAt(): ?\DateTimeInterface
    {
        return $this->subscriped_at;
    }

    public function setSubscripedAt(\DateTimeInterface $subscriped_at): static
    {
        $this->subscriped_at = $subscriped_at;

        return $this;
    }
}
