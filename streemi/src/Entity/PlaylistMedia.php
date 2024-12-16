<?php

namespace App\Entity;

use App\Repository\PlaylistMediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistMediaRepository::class)]
class PlaylistMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $added_at = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?playlist $playlist_id = null;

    /**
     * @var Collection<int, media>
     */
    #[ORM\ManyToMany(targetEntity: media::class)]
    private Collection $media_id;

    public function __construct()
    {
        $this->media_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddedAt(): ?\DateTimeInterface
    {
        return $this->added_at;
    }

    public function setAddedAt(?\DateTimeInterface $added_at): static
    {
        $this->added_at = $added_at;

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

    /**
     * @return Collection<int, media>
     */
    public function getMediaId(): Collection
    {
        return $this->media_id;
    }

    public function addMediaId(media $mediaId): static
    {
        if (!$this->media_id->contains($mediaId)) {
            $this->media_id->add($mediaId);
        }

        return $this;
    }

    public function removeMediaId(media $mediaId): static
    {
        $this->media_id->removeElement($mediaId);

        return $this;
    }
}
