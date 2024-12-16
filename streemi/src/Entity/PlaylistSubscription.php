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

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $user_id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?playlist $playlist_id = null;

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

    public function getUserId(): ?user
    {
        return $this->user_id;
    }

    public function setUserId(?user $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getPlaylistId(): ?playlist
    {
        return $this->playlist_id;
    }

    public function setPlaylistId(?playlist $playlist_id): static
    {
        $this->playlist_id = $playlist_id;

        return $this;
    }
}
