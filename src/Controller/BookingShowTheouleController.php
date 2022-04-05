<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\RoomsTheoule;
use App\Entity\BookingTheoule;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingShowTheouleController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/Ma-Reservation-Theoule/{id}', name: 'theoule/app_booking_show_theoule')]

    public function index($id): Response
    {
        $booking = $this->entityManager->getRepository(BookingTheoule::class)->find($id);
        $roomTheoule = $this->entityManager->getRepository(RoomsTheoule::class)->findAll();
        $user = $this->entityManager->getRepository(Users::class)->findAll();

        return $this->render('theoule/booking_show_theoule/index.html.twig', [

            'booking' => $booking,
            'room' => $roomTheoule,
            'user' => $user,
        ]);        
    }
}
