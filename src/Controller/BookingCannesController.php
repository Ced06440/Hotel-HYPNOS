<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\RoomsCannes;
use App\Entity\BookingCannes;
use App\Form\BookingCannesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingCannesController extends AbstractController
{
    
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/booking_cannes', name: 'cannes/app_booking_cannes')]
    public function index(Request $request): Response
    {   
        $booking = new BookingCannes();
        $bookingForm = $this->createForm(BookingCannesType::class, $booking);
        $bookingForm->handleRequest($request);

        if($bookingForm->isSubmitted() && $bookingForm->isValid()){
            
            $suiteAvailable = $this->entityManager->getRepository(BookingCannes::class)->findAll();
            $startDate = $booking->getStartDate();
            $endDate = $booking->getEndDate();
            
            $rooms = $booking->getRooms();

            $user = $this->getUser();

            $booking->setBookers($this->getUser($user));
            $booking->setCreatedAt(new \DateTime('now'));

            foreach($suiteAvailable as $room)
            {
                if(
                    $rooms == $room->getRooms()
                    && (
                    ( $startDate >= $room->getStartDate() && $startDate < $room->getEndDate() )
                    ||
                    ( $endDate > $room->getStartDate() && $endDate <= $room->getEndDate() )
                    ||
                    ( $room->getStartDate() >= $startDate && $room->getStartDate() <= $endDate )
                    )
                ) {
                    return $this->redirectToRoute('cannes/app_booking_cannes') ;  
            }
        }
    
        $this->entityManager->persist($booking);
        $this->entityManager->flush();
                
        return $this->redirectToRoute('cannes/app_booking_show_cannes', ['id' => $booking->getId()]);
        }

        $roomCannes = $this->entityManager->getRepository(RoomsCannes::class)->findAll();
        $hotelCannes = $this->entityManager->getRepository(Hotel::class)->findBy(array('name'=>'Hypnos Cannes'));

        return $this->render('cannes/booking_cannes/index.html.twig', 
        [   
            'roomCannes' => $roomCannes,
            'hotelCannes' => $hotelCannes,
            'bookingCannesForm' => $bookingForm->createView(),
        ]);
        
    }
}
