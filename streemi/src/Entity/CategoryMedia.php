<?php

namespace App\Entity;

use App\Repository\CategoryMediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryMediaRepository::class)]
class CategoryMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, media>
     */
    #[ORM\OneToMany(targetEntity: media::class, mappedBy: 'categoryMedia')]
    private Collection $media_id;

    /**
     * @var Collection<int, category>
     */
    #[ORM\ManyToMany(targetEntity: category::class)]
    private Collection $category_id;

    public function __construct()
    {
        $this->media_id = new ArrayCollection();
        $this->category_id = new ArrayCollection();
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
            $mediaId->setCategoryMedia($this);
        }

        return $this;
    }

    public function removeMediaId(media $mediaId): static
    {
        if ($this->media_id->removeElement($mediaId)) {
            // set the owning side to null (unless already changed)
            if ($mediaId->getCategoryMedia() === $this) {
                $mediaId->setCategoryMedia(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, category>
     */
    public function getCategoryId(): Collection
    {
        return $this->category_id;
    }

    public function addCategoryId(category $categoryId): static
    {
        if (!$this->category_id->contains($categoryId)) {
            $this->category_id->add($categoryId);
        }

        return $this;
    }

    public function removeCategoryId(category $categoryId): static
    {
        $this->category_id->removeElement($categoryId);

        return $this;
    }
}
