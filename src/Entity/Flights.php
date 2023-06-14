<?php

namespace App\Entity;

use App\Repository\FlightsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FlightsRepository::class)]
class Flights
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $flight_nb = null;

    #[ORM\Column]
    #[Assert\GreaterThanOrEqual('today UTC', message: 'La date de départ ne peut pas être dans le passé')]
    #[Assert\LessThan(propertyPath: 'arrival_datetime', message: 'La date de départ ne peut pas être supérieur à la date d\'arrivée')]
    private ?\DateTimeImmutable $departure_datetime = null;

    #[ORM\ManyToOne(inversedBy: 'flights')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cities $departure_city = null;

    #[ORM\Column]
    
    #[Assert\GreaterThanOrEqual('today UTC', message: 'la date d\'arrivée ne peut pas être dans le passé')]
    #[Assert\GreaterThanOrEqual(propertyPath: 'departure_datetime', message: 'la date d\'arrivée ne peut pas être inférieur à la date de départ')]
    private ?\DateTimeImmutable $arrival_datetime = null;

    #[ORM\ManyToOne(inversedBy: 'flights')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cities $arrival_city = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column]
    private ?bool $discount = null;

    #[ORM\Column]
    private ?int $available_seat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFlightNb(): ?string
    {
        return $this->flight_nb;
    }

    public function setFlightNb($flight_nb): self
    {
        $this->flight_nb = $flight_nb;

        return $this;
    }

    public function getDepartureDatetime(): ?\DateTimeImmutable
    {
        return $this->departure_datetime;
    }

    public function setDepartureDatetime(\DateTimeImmutable $departure_datetime): self
    {
        $this->departure_datetime = $departure_datetime;

        return $this;
    }

    public function getDepartureCity(): ?Cities
    {
        return $this->departure_city;
    }

    public function setDepartureCity(?Cities $departure_city): self
    {
        $this->departure_city = $departure_city;

        return $this;
    }

    public function getArrivalDatetime(): ?\DateTimeImmutable
    {
        return $this->arrival_datetime;
    }

    public function setArrivalDatetime(\DateTimeImmutable $arrival_datetime): self
    {
        $this->arrival_datetime = $arrival_datetime;

        return $this;
    }

    public function getArrivalCity(): ?Cities
    {
        return $this->arrival_city;
    }

    public function setArrivalCity(?Cities $arrival_city): self
    {
        $this->arrival_city = $arrival_city;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function isDiscount(): ?bool
    {
        return $this->discount;
    }

    public function setDiscount(bool $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getAvailableSeat(): ?int
    {
        return $this->available_seat;
    }

    public function setAvailableSeat(int $available_seat): self
    {
        $this->available_seat = $available_seat;

        return $this;
    }

    public function randNbFlight()
    {
        $lettres = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $chiffres = [1,2,3,4,5,6,7,8,9];
        $randFlight = [];
        for($i = 0; $i < 2; $i++){
            $randlettre = rand(0,25);
            $randFlight[]= $lettres[$randlettre];
        }
        for($i = 0; $i < 4; $i++){
            $randChiffres = rand(0,8);
            $randFlight[]= strval($chiffres[$randChiffres]) ;
        }
        $stringRandFlight = implode("", $randFlight);
        return $stringRandFlight;
        
    }

    
}
