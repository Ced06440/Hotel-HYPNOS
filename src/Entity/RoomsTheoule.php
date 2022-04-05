<?php

namespace App\Entity;

use App\Repository\RoomsTheouleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomsTheouleRepository::class)]
class RoomsTheoule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'integer')]
    private $price;

    #[ORM\OneToMany(mappedBy: 'rooms', targetEntity: BookingTheoule::class)]
    private $bookingTheoules;

    public function __construct()
    {
        $this->bookingTheoules = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    /**
     * @return Collection<int, BookingTheoule>
     */
    public function getBookingTheoules(): Collection
    {
        return $this->bookingTheoules;
    }

    public function addBookingTheoule(BookingTheoule $bookingTheoule): self
    {
        if (!$this->bookingTheoules->contains($bookingTheoule)) {
            $this->bookingTheoules[] = $bookingTheoule;
            $bookingTheoule->setRooms($this);
        }

        return $this;
    }

    public function removeBookingTheoule(BookingTheoule $bookingTheoule): self
    {
        if ($this->bookingTheoules->removeElement($bookingTheoule)) {
            // set the owning side to null (unless already changed)
            if ($bookingTheoule->getRooms() === $this) {
                $bookingTheoule->setRooms(null);
            }
        }

        return $this;
    }
}
