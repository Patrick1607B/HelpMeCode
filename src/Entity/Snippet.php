<?php

namespace App\Entity;

use App\Repository\SnippetRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SnippetRepository::class)]
class Snippet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $syntax = null;

    #[ORM\ManyToOne(inversedBy: 'snippets')]
    private ?Category $relationCategory = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSyntax(): ?string
    {
        return $this->syntax;
    }

    public function setSyntax(string $syntax): static
    {
        $this->syntax = $syntax;

        return $this;
    }

    public function getRelationCategory(): ?Category
    {
        return $this->relationCategory;
    }

    public function setRelationCategory(?Category $relationCategory): static
    {
        $this->relationCategory = $relationCategory;

        return $this;
    }
}
