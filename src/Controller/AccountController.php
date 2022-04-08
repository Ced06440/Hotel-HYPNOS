<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\RoomsNice;
use App\Entity\RoomsParis;
use App\Entity\BookingNice;
use App\Entity\RoomsCannes;
use App\Entity\BookingParis;
use App\Entity\RoomsAuxerre;
use App\Entity\RoomsTheoule;
use App\Entity\BookingCannes;
use App\Entity\RoomsChamonix;
use App\Entity\BookingAuxerre;
use App\Entity\BookingTheoule;
use App\Entity\RoomsMandelieu;
use App\Entity\BookingChamonix;
use App\Entity\BookingMandelieu;
use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{
    
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/compte', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig');
    }

    #[Route('/compte/bookings', name: 'app_account_bookings')]
    public function bookings()
    {
        $bookingsAuxerre = $this->entityManager->getRepository(BookingAuxerre::class)->findAll();
        $roomAuxerre = $this->entityManager->getRepository(RoomsAuxerre::class)->findAll();
        

        $bookingParis = $this->entityManager->getRepository(BookingParis::class)->findAll();
        $roomParis = $this->entityManager->getRepository(RoomsParis::class)->findAll();

        $bookingCannes = $this->entityManager->getRepository(BookingCannes::class)->findAll();
        $roomCannes = $this->entityManager->getRepository(RoomsCannes::class)->findAll();

        $bookingChamonix = $this->entityManager->getRepository(BookingChamonix::class)->findAll();
        $roomChamonix = $this->entityManager->getRepository(RoomsChamonix::class)->findAll();

        $bookingNice = $this->entityManager->getRepository(BookingNice::class)->findAll();
        $roomNice = $this->entityManager->getRepository(RoomsNice::class)->findAll();

        $bookingMandelieu = $this->entityManager->getRepository(BookingMandelieu::class)->findAll();
        $roomMandelieu = $this->entityManager->getRepository(RoomsMandelieu::class)->findAll();

        $bookingTheoule = $this->entityManager->getRepository(BookingTheoule::class)->findAll();
        $roomTheoule = $this->entityManager->getRepository(RoomsTheoule::class)->findAll();

        $hotel = $this->entityManager->getRepository(Hotel::class)->findAll();

        

        return $this->render('account/bookings.html.twig',
    [
        
        'bookingAuxerre' => $bookingsAuxerre,
        'roomAuxerre' => $roomAuxerre,

        'bookingParis' => $bookingParis,
        'roomParis' => $roomParis,

        'bookingNice' => $bookingNice,
        'roomNice' => $roomNice,

        'bookingChamonix' => $bookingChamonix,
        'roomChamonix' => $roomChamonix,

        'bookingCannes' => $bookingCannes,
        'roomCannes' => $roomCannes,

        'bookingMandelieu' => $bookingMandelieu,
        'roomMandelieu' => $roomMandelieu,

        'bookingTheoule' => $bookingTheoule,
        'roomTheoule' => $roomTheoule,

        'hotel' => $hotel,

    ]);
    }

    #[Route('/compte/delete/bookings{id}', name: 'app_account_delete_bookings')]

    public function deleteBooking(BookingAuxerre $bookingAuxerre)
    {
        $deleteBooking = $this->entityManager;
        $deleteBooking->remove($bookingAuxerre);
        $deleteBooking->flush();

        return $this->render('account/bookings.html.twig');
    }
}