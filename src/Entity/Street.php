<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Streets
 *
 * @ORM\Table(name="streets", indexes={@ORM\Index(name="streets_city_id_foreign", columns={"city_id"})})
 * @ORM\Entity
 */
class Street
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=0, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=30, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var City
     *
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     * })
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Building", mappedBy="street")
     */
    private $buildings;

    public function __construct()
    {
        $this->buildings = new ArrayCollection();
    }

    /**
     * @return Collection|Building[]
     */
    public function getBuildings(): Collection
    {
        return $this->buildings;
    }

    public function addUser(Building $user): self
    {
        if (!$this->buildings->contains($user)) {
            $this->buildings[] = $user;
            $user->setStreet($this);
        }

        return $this;
    }

    public function removeUser(Building $user): self
    {
        if ($this->buildings->contains($user)) {
            $this->buildings->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getStreet() === $this) {
                $user->setStreet(null);
            }
        }

        return $this;
    }
}
