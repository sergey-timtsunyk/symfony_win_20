<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Cities
 *
 * @ORM\Table(name="cities")
 * @ORM\Entity(repositoryClass="App\Repository\CityRepository")
 * @ORM\HasLifecycleCallbacks
 */
class City
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="smallint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=20, nullable=false)
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "City name must be at least {{ limit }} characters long",
     *      maxMessage = "City name cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false
     * )
     * @Assert\NotBlank()
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setCreatedAt(): void
    {
        $this->createdAt = new \DateTime();
    }

    public function setUpdatedAt(): void
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->setCreatedAt();
        $this->setUpdatedAt();
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->setUpdatedAt();
    }
}
