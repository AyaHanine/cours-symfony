<?php

namespace App\Entity;

use App\Repository\MediaLanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaLanguageRepository::class)]
class MediaLanguage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, media>
     */
    #[ORM\ManyToMany(targetEntity: media::class)]
    private Collection $media_id;

    /**
     * @var Collection<int, language>
     */
    #[ORM\ManyToMany(targetEntity: language::class)]
    private Collection $language_id;

    public function __construct()
    {
        $this->media_id = new ArrayCollection();
        $this->language_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, language>
     */
    public function getLanguageId(): Collection
    {
        return $this->language_id;
    }

    public function addLanguageId(language $languageId): static
    {
        if (!$this->language_id->contains($languageId)) {
            $this->language_id->add($languageId);
        }

        return $this;
    }

    public function removeLanguageId(language $languageId): static
    {
        $this->language_id->removeElement($languageId);

        return $this;
    }
}
