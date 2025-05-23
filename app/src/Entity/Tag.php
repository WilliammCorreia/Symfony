<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Manga::class, mappedBy: 'tags')]
    private Collection $mangas;

    public function __construct()
    {
        $this->mangas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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
            $manga->addTag($this); // Synchronise l'autre côté de la relation
        }

        return $this;
    }

    public function removeManga(Manga $manga): static
    {
        if ($this->mangas->removeElement($manga)) {
            $manga->removeTag($this); // Synchronise l'autre côté de la relation
        }
        
        return $this;
    }

    public function setMangas(?Manga $mangas): static
    {
        $this->mangas = $mangas;

        return $this;
    }
}
