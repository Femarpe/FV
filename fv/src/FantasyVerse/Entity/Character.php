<?php

namespace Fv\FantasyVerse\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fv\FantasyVerse\Repository\CharacterRepository;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CharacterRepository::class)]
#[ORM\Table(name: '`character`')]
class Character extends Entity
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $health = null;

    #[ORM\Column]
    private ?int $ca = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $uuid): void
    {
        $this->id = $uuid;
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

    public function getHealth(): ?int
    {
        return $this->health;
    }

    public function setHealth(int $health): static
    {
        $this->health = $health;

        return $this;
    }

    public function getCa(): ?int
    {
        return $this->ca;
    }

    public function setCa(int $ca): static
    {
        $this->ca = $ca;

        return $this;
    }

    public function receiveDamage(int $damageReceived): void
    {
        $this->health = $this->health - $damageReceived;
    }
}
