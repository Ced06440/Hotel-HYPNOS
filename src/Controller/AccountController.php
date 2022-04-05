<?php

namespace App\Controller;

use App\Entity\BookingAuxerre;
use App\Entity\BookingParis;
use App\Entity\Hotel;
use App\Entity\RoomsAuxerre;
use App\Entity\RoomsParis;
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

        return $this->render('account/bookings.html.twig',
    [
        
        'bookingAuxerre' => $bookingsAuxerre,
        'roomAuxerre' => $roomAuxerre,

        'bookingParis' => $bookingParis,
        'roomParis' => $roomParis,
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