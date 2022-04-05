<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\RoomsMandelieu;
use App\Entity\BookingMandelieu;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingShowMandelieuController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/Ma-Reservation-Mandelieu/{id}', name: 'mandelieu/app_booking_show_mandelieu')]

    public function index($id): Response
    {
        $booking = $this->entityManager->getRepository(BookingMandelieu::class)->find($id);
        $roomMandelieu = $this->entityManager->getRepository(RoomsMandelieu::class)->findAll();
        $user = $this->entityManager->getRepository(Users::class)->findAll();

        return $this->render('mandelieu/booking_show_mandelieu/index.html.twig', [

            'booking' => $booking,
            'room' => $roomMandelieu,
            'user' => $user,
        ]);        
    }
}
