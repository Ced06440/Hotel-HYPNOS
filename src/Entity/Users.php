<?php

namespace App\Entity;

use App\Entity\Hotel;
use App\Entity\Booking;
use App\Entity\BookingNice;
use App\Entity\BookingParis;
use App\Entity\BookingCannes;
use App\Entity\BookingAuxerre;
use App\Entity\BookingTheoule;
use App\Entity\BookingChamonix;
use App\Entity\BookingMandelieu;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UsersRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\OneToOne(targetEntity: Hotel::class, cascade: ['persist', 'remove'])]
    private $hotel;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $lastname;

    #[ORM\OneToMany(mappedBy: 'booker', targetEntity: Booking::class)]
    private $endDate;

    #[ORM\OneToMany(mappedBy: 'bookers', targetEntity: BookingAuxerre::class)]
    private $bookingAuxerre;

    #[ORM\OneToMany(mappedBy: 'bookers', targetEntity: BookingParis::class)]
    private $bookingParis;

    #[ORM\OneToMany(mappedBy: 'bookers', targetEntity: BookingCannes::class)]
    private $bookingCannes;

    #[ORM\OneToMany(mappedBy: 'bookers', targetEntity: BookingNice::class)]
    private $bookingNice;

    #[ORM\OneToMany(mappedBy: 'bookers', targetEntity: BookingMandelieu::class)]
    private $bookingMandelieu;

    #[ORM\OneToMany(mappedBy: 'bookers', targetEntity: BookingTheoule::class)]
    private $bookingTheoule;

    #[ORM\OneToMany(mappedBy: 'bookers', targetEntity: BookingChamonix::class)]
    private $bookingChamonix;



    public function __toString()
    {
        return $this->getlastName();
    }

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->endDate = new ArrayCollection();
        $this->bookingAuxerre = new ArrayCollection();
        $this->bookingParis = new ArrayCollection();
        $this->bookingCannes = new ArrayCollection();
        $this->bookingNice = new ArrayCollection();
        $this->bookingMandelieu = new ArrayCollection();
        $this->bookingTheoule = new ArrayCollection();
        $this->bookingChamonix = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getEndDate(): Collection
    {
        return $this->endDate;
    }

    public function addEndDate(Booking $endDate): self
    {
        if (!$this->endDate->contains($endDate)) {
            $this->endDate[] = $endDate;
            $endDate->setBooker($this);
        }

        return $this;
    }

    public function removeEndDate(Booking $endDate): self
    {
        if ($this->endDate->removeElement($endDate)) {
            // set the owning side to null (unless already changed)
            if ($endDate->getBooker() === $this) {
                $endDate->setBooker(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BookingAuxerre>
     */
    public function getBookingAuxerre(): Collection
    {
        return $this->bookingAuxerre;
    }

    public function addBookingAuxerre(BookingAuxerre $bookingAuxerre): self
    {
        if (!$this->bookingAuxerre->contains($bookingAuxerre)) {
            $this->bookingAuxerre[] = $bookingAuxerre;
            $bookingAuxerre->setBookers($this);
        }

        return $this;
    }

    public function removeBookingAuxerre(BookingAuxerre $bookingAuxerre): self
    {
        if ($this->bookingAuxerre->removeElement($bookingAuxerre)) {
            // set the owning side to null (unless already changed)
            if ($bookingAuxerre->getBookers() === $this) {
                $bookingAuxerre->setBookers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BookingParis>
     */
    public function getBookingParis(): Collection
    {
        return $this->bookingParis;
    }

    public function addBookingParis(BookingParis $bookingParis): self
    {
        if (!$this->bookingParis->contains($bookingParis)) {
            $this->bookingParis[] = $bookingParis;
            $bookingParis->setBookers($this);
        }

        return $this;
    }

    public function removeBookingPari(BookingParis $bookingParis): self
    {
        if ($this->bookingParis->removeElement($bookingParis)) {
            // set the owning side to null (unless already changed)
            if ($bookingParis->getBookers() === $this) {
                $bookingParis->setBookers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BookingCannes>
     */
    public function getBookingCannes(): Collection
    {
        return $this->bookingCannes;
    }

    public function addBookingCanne(BookingCannes $bookingCannes): self
    {
        if (!$this->bookingCannes->contains($bookingCannes)) {
            $this->bookingCannes[] = $bookingCannes;
            $bookingCannes->setBookers($this);
        }

        return $this;
    }

    public function removeBookingCannes(BookingCannes $bookingCannes): self
    {
        if ($this->bookingCannes->removeElement($bookingCannes)) {
            // set the owning side to null (unless already changed)
            if ($bookingCannes->getBookers() === $this) {
                $bookingCannes->setBookers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BookingNice>
     */
    public function getBookingNice(): Collection
    {
        return $this->bookingNice;
    }

    public function addBookingNice(BookingNice $bookingNice): self
    {
        if (!$this->bookingNice->contains($bookingNice)) {
            $this->bookingNice[] = $bookingNice;
            $bookingNice->setBookers($this);
        }

        return $this;
    }

    public function removeBookingNice(BookingNice $bookingNice): self
    {
        if ($this->bookingNice->removeElement($bookingNice)) {
            // set the owning side to null (unless already changed)
            if ($bookingNice->getBookers() === $this) {
                $bookingNice->setBookers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BookingMandelieu>
     */
    public function getBookingMandelieu(): Collection
    {
        return $this->bookingMandelieu;
    }

    public function addBookingMandelieu(BookingMandelieu $bookingMandelieu): self
    {
        if (!$this->bookingMandelieu->contains($bookingMandelieu)) {
            $this->bookingMandelieu[] = $bookingMandelieu;
            $bookingMandelieu->setBookers($this);
        }

        return $this;
    }

    public function removeBookingMandelieu(BookingMandelieu $bookingMandelieu): self
    {
        if ($this->bookingMandelieu->removeElement($bookingMandelieu)) {
            // set the owning side to null (unless already changed)
            if ($bookingMandelieu->getBookers() === $this) {
                $bookingMandelieu->setBookers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BookingTheoule>
     */
    public function getBookingTheoule(): Collection
    {
        return $this->bookingTheoule;
    }

    public function addBookingTheoule(BookingTheoule $bookingTheoule): self
    {
        if (!$this->bookingTheoule->contains($bookingTheoule)) {
            $this->bookingTheoule[] = $bookingTheoule;
            $bookingTheoule->setBookers($this);
        }

        return $this;
    }

    public function removeBookingTheoule(BookingTheoule $bookingTheoule): self
    {
        if ($this->bookingTheoule->removeElement($bookingTheoule)) {
            // set the owning side to null (unless already changed)
            if ($bookingTheoule->getBookers() === $this) {
                $bookingTheoule->setBookers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BookingChamonix>
     */
    public function getBookingChamonix(): Collection
    {
        return $this->bookingChamonix;
    }

    public function addBookingChamonix(BookingChamonix $bookingChamonix): self
    {
        if (!$this->bookingChamonix->contains($bookingChamonix)) {
            $this->bookingChamonix[] = $bookingChamonix;
            $bookingChamonix->setBookers($this);
        }

        return $this;
    }

    public function removeBookingChamonix(BookingChamonix $bookingChamonix): self
    {
        if ($this->bookingChamonix->removeElement($bookingChamonix)) {
            // set the owning side to null (unless already changed)
            if ($bookingChamonix->getBookers() === $this) {
                $bookingChamonix->setBookers(null);
            }
        }

        return $this;
    }


}
