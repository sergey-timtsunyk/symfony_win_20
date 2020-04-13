<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApartmentRepository")
 */
class Apartment
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
     * @ORM\Column(type="float")
     */
    private $area;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $countPeople;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Entity\Building", inversedBy="apartments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $building;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="apartments")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ServiceBuilding", mappedBy="apartment")
     */
    private $serviceBuildings;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->serviceBuildings = new ArrayCollection();
    }

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

    public function getArea(): ?float
    {
        return $this->area;
    }

    public function setArea(float $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getCountPeople(): ?int
    {
        return $this->countPeople;
    }

    public function setCountPeople(?int $countPeople): self
    {
        $this->countPeople = $countPeople;

        return $this;
    }

    public function getBuilding(): ?Building
    {
        return $this->building;
    }

    public function setBuilding(?Building $building): self
    {
        $this->building = $building;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
        }

        return $this;
    }

    /**
     * @return Collection|ServiceBuilding[]
     */
    public function getServiceBuildings(): Collection
    {
        return $this->serviceBuildings;
    }

    public function addServiceBuilding(ServiceBuilding $serviceBuilding): self
    {
        if (!$this->serviceBuildings->contains($serviceBuilding)) {
            $this->serviceBuildings[] = $serviceBuilding;
            $serviceBuilding->setApartment($this);
        }

        return $this;
    }

    public function removeServiceBuilding(ServiceBuilding $serviceBuilding): self
    {
        if ($this->serviceBuildings->contains($serviceBuilding)) {
            $this->serviceBuildings->removeElement($serviceBuilding);
            // set the owning side to null (unless already changed)
            if ($serviceBuilding->getApartment() === $this) {
                $serviceBuilding->setApartment(null);
            }
        }

        return $this;
    }
}
