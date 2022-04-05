<?php

namespace App\Entity;

use App\Repository\RoomsCannesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomsCannesRepository::class)]
class RoomsCannes
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

    #[ORM\OneToMany(mappedBy: 'rooms', targetEntity: BookingCannes::class)]
    private $bookingCannes;

    public function __construct()
    {
        $this->bookingCannes = new ArrayCollection();
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
     * @return Collection<int, BookingCannes>
     */
    public function getBookingCannes(): Collection
    {
        return $this->bookingCannes;
    }

    public function addBookingCanne(BookingCannes $bookingCanne): self
    {
        if (!$this->bookingCannes->contains($bookingCanne)) {
            $this->bookingCannes[] = $bookingCanne;
            $bookingCanne->setRooms($this);
        }

        return $this;
    }

    public function removeBookingCanne(BookingCannes $bookingCanne): self
    {
        if ($this->bookingCannes->removeElement($bookingCanne)) {
            // set the owning side to null (unless already changed)
            if ($bookingCanne->getRooms() === $this) {
                $bookingCanne->setRooms(null);
            }
        }

        return $this;
    }
}
