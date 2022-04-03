<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Hotel;
use App\Entity\BookingAuxerre;
use App\Entity\RoomsAuxerre;
use App\Form\BookingAuxerreType;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingAuxerreController extends AbstractController
{
    
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }

    
    #[Route('/booking_auxerre', name: 'auxerre/app_booking_auxerre')]
    public function index(Request $request): Response
    {   
        $booking = new BookingAuxerre();
        
        $bookingForm = $this->createForm(BookingAuxerreType::class, $booking);

        $bookingForm->handleRequest($request);

        $startDate = $booking->getStartDate();
        $endDate = $booking->getEndDate();
        $rooms = $booking->getRooms();

        $date = $this->entityManager->getRepository(BookingAuxerre::class)->findOneBy(array('startDate'));
        $test = ($date->getEndDate() - $startDate);

        dd($date);

        if($bookingForm->isSubmitted() && $bookingForm->isValid()){
            
            $user = $this->getUser();

            $booking->setBookers($this->getUser($user));
            $booking->setCreatedAt(new \DateTime('now'));

            $startDate = $booking->getStartDate();
            $endDate = $booking->getEndDate();
            $rooms = $booking->getRooms();

            $this->entityManager->persist($booking);
            $this->entityManager->flush();
            
            return $this->redirectToRoute('auxerre/app_booking_show_auxerre', ['id' => $booking->getId()]);
            
        }    

        $roomAuxerre = $this->entityManager->getRepository(RoomsAuxerre::class)->findAll();
        $hotelAuxerre = $this->entityManager->getRepository(Hotel::class)->findBy(array('name'=>'Hypnos Auxerre'));

        return $this->render('auxerre/booking_auxerre/index.html.twig', 
        [   
            'roomAuxerre' => $roomAuxerre,
            'hotelAuxerre' => $hotelAuxerre,
            'bookingAuxerreForm' => $bookingForm->createView(),
        ]);
    }  

}
