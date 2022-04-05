<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\RoomsChamonix;
use App\Entity\BookingChamonix;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingShowChamonixController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/Ma-Reservation-Chamonix/{id}', name: 'chamonix/app_booking_show_chamonix')]

    public function index($id): Response
    {
        $booking = $this->entityManager->getRepository(BookingChamonix::class)->find($id);
        $roomChamonix = $this->entityManager->getRepository(RoomsChamonix::class)->findAll();
        $user = $this->entityManager->getRepository(Users::class)->findAll();

        return $this->render('chamonix/booking_show_chamonix/index.html.twig', [

            'booking' => $booking,
            'room' => $roomChamonix,
            'user' => $user,
        ]);        
    }
}
