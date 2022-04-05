<?php

namespace App\Controller;

use App\Entity\BookingParis;
use App\Entity\RoomsParis;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingShowParisController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/Ma-Reservation-Paris/{id}', name: 'paris/app_booking_show_paris')]

    public function index($id): Response
    {
        $booking = $this->entityManager->getRepository(BookingParis::class)->find($id);
        $roomParis = $this->entityManager->getRepository(RoomsParis::class)->findAll();
        $user = $this->entityManager->getRepository(Users::class)->findAll();

        return $this->render('paris/booking_show_paris/index.html.twig', [

            'booking' => $booking,
            'room' => $roomParis,
            'user' => $user,
        ]);        
    }
}