<?php

namespace App\Entity;

use App\Repository\WatchHistoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WatchHistoryRepository::class)]
class WatchHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $last_watched = null;

    #[ORM\Column]
    private ?int $number_of_views = null;

    /**
     * @var Collection<int, Media>
     */
    #[ORM\ManyToMany(targetEntity: Media::class, inversedBy: 'watchHistories')]
    private Collection $media_id;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $user_id = null;

    public function __construct()
    {
        $this->media_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastWatched(): ?\DateTimeInterface
    {
        return $this->last_watched;
    }

    public function setLastWatched(\DateTimeInterface $last_watched): static
    {
        $this->last_watched = $last_watched;

        return $this;
    }

    public function getNumberOfViews(): ?int
    {
        return $this->number_of_views;
    }

    public function setNumberOfViews(int $number_of_views): static
    {
        $this->number_of_views = $number_of_views;

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMediaId(): Collection
    {
        return $this->media_id;
    }

    public function addMediaId(Media $mediaId): static
    {
        if (!$this->media_id->contains($mediaId)) {
            $this->media_id->add($mediaId);
        }

        return $this;
    }

    public function removeMediaId(Media $mediaId): static
    {
        $this->media_id->removeElement($mediaId);

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
}
