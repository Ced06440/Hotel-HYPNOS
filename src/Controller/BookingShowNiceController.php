<?php

namespace App\Controller;

use App\Entity\RoomsNice;
use App\Entity\BookingNice;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingShowNiceController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/Ma-Reservation-Nice/{id}', name: 'nice/app_booking_show_nice')]

    public function index($id): Response
    {
        $booking = $this->entityManager->getRepository(BookingNice::class)->find($id);
        $roomNice = $this->entityManager->getRepository(RoomsNice::class)->findAll();
        $user = $this->entityManager->getRepository(Users::class)->findAll();

        return $this->render('nice/booking_show_nice/index.html.twig', [

            'booking' => $booking,
            'room' => $roomNice,
            'user' => $user,
        ]);        
    }
}
