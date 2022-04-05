<?php

namespace App\Controller;

use App\Entity\BookingCannes;
use App\Entity\RoomsCannes;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingShowCannesController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/Ma-Reservation-Cannes/{id}', name: 'cannes/app_booking_show_cannes')]

    public function index($id): Response
    {
        $booking = $this->entityManager->getRepository(BookingCannes::class)->find($id);
        $roomCannes = $this->entityManager->getRepository(RoomsCannes::class)->findAll();
        $user = $this->entityManager->getRepository(Users::class)->findAll();

        return $this->render('cannes/booking_show_cannes/index.html.twig', [

            'booking' => $booking,
            'room' => $roomCannes,
            'user' => $user,
        ]);        
    }
}