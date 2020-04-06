<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BuildingRepository")
 */
class Building
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity="Street", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $street;

    /**
     * @ORM\Column(type="integer")
     */
    private $sectionCount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getStreet(): ?Street
    {
        return $this->street;
    }

    public function setStreet(?Street $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getUsers(): ?string
    {
        return $this->users;
    }

    public function setUsers(string $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getSectionCount(): ?int
    {
        return $this->sectionCount;
    }

    public function setSectionCount(int $sectionCount): self
    {
        $this->sectionCount = $sectionCount;

        return $this;
    }
}
