<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $label = null;

    /**
     * @var Collection<int, Manga>
     */
    #[ORM\OneToMany(targetEntity: Manga::class, mappedBy: 'category', orphanRemoval: true)]
    private Collection $mangas;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\PrePersist]
    public function setTimestampsValue(): void
    {
        if ($this->created_at == null) {
            $this->created_at = new \DateTimeImmutable();
        }
        $this->updated_at = new \DateTimeImmutable();
    }

    public function __construct()
    {
        $this->mangas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): static
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, Manga>
     */
    public function getMangas(): Collection
    {
        return $this->mangas;
    }

    public function addManga(Manga $manga): static
    {
        if (!$this->mangas->contains($manga)) {
            $this->mangas->add($manga);
            $manga->setCategory($this);
        }

        return $this;
    }

    public function removeManga(Manga $manga): static
    {
        if ($this->mangas->removeElement($manga)) {
            // set the owning side to null (unless already changed)
            if ($manga->getCategory() === $this) {
                $manga->setCategory(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->label;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
