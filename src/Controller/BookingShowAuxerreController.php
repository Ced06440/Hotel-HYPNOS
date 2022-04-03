<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\BookingAuxerre;
use App\Entity\RoomsAuxerre;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingShowAuxerreController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/Ma-Reservation-Auxerre/{id}', name: 'auxerre/app_booking_show_auxerre')]

    public function index($id): Response
    {
        $booking = $this->entityManager->getRepository(BookingAuxerre::class)->find($id);
        $roomAuxerre = $this->entityManager->getRepository(RoomsAuxerre::class)->findAll();
        $user = $this->entityManager->getRepository(Users::class)->findAll();

        return $this->render('auxerre/booking_show_auxerre/index.html.twig', [

            'booking' => $booking,
            'room' => $roomAuxerre,
            'user' => $user,
        ]);        
    }
}
