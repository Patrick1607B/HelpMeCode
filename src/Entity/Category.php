<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'categories')]
    private ?Language $relationLanguage = null;

    /**
     * @var Collection<int, Snippet>
     */
    #[ORM\OneToMany(targetEntity: Snippet::class, mappedBy: 'relationCategory')]
    private Collection $snippets;

    public function __construct()
    {
        $this->snippets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
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

    public function getRelationLanguage(): ?Language
    {
        return $this->relationLanguage;
    }

    public function setRelationLanguage(?Language $relationLanguage): static
    {
        $this->relationLanguage = $relationLanguage;

        return $this;
    }

    /**
     * @return Collection<int, Snippet>
     */
    public function getSnippets(): Collection
    {
        return $this->snippets;
    }

    public function addSnippet(Snippet $snippet): static
    {
        if (!$this->snippets->contains($snippet)) {
            $this->snippets->add($snippet);
            $snippet->setRelationCategory($this);
        }

        return $this;
    }

    public function removeSnippet(Snippet $snippet): static
    {
        if ($this->snippets->removeElement($snippet)) {
            // set the owning side to null (unless already changed)
            if ($snippet->getRelationCategory() === $this) {
                $snippet->setRelationCategory(null);
            }
        }

        return $this;
    }
}
