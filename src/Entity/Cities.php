<?php

namespace App\Entity;

use App\Repository\CitiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CitiesRepository::class)]
class Cities
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'departure_city', targetEntity: Flights::class)]
    private Collection $flights;

    public function __construct()
    {
        $this->flights = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Flights>
     */
    public function getFlights(): Collection
    {
        return $this->flights;
    }

    public function addFlight(Flights $flight): self
    {
        if (!$this->flights->contains($flight)) {
            $this->flights->add($flight);
            $flight->setDepartureCity($this);
        }

        return $this;
    }

    public function removeFlight(Flights $flight): self
    {
        if ($this->flights->removeElement($flight)) {
            // set the owning side to null (unless already changed)
            if ($flight->getDepartureCity() === $this) {
                $flight->setDepartureCity(null);
            }
        }

        return $this;
    }
}
