<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\RoomsChamonix;
use App\Entity\BookingChamonix;
use App\Form\BookingChamonixType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingChamonixController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/booking_chamonix', name: 'chamonix/app_booking_chamonix')]
    public function index(Request $request): Response
    {   
        $booking = new BookingChamonix();
        $bookingForm = $this->createForm(BookingChamonixType::class, $booking);
        $bookingForm->handleRequest($request);

        if($bookingForm->isSubmitted() && $bookingForm->isValid()){
            
            $suiteAvailable = $this->entityManager->getRepository(BookingChamonix::class)->findAll();
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
                    $this->addFlash('warning', 'Les dates que vous avez choisies sont déjà prise, pour cette chambre.');
                    return $this->redirectToRoute('chamonix/app_booking_chamonix') ;  
            }
        }
    
        $this->entityManager->persist($booking);
        $this->entityManager->flush();
                
        return $this->redirectToRoute('chamonix/app_booking_show_chamonix', ['id' => $booking->getId()]);
        }

        $roomChamonix = $this->entityManager->getRepository(RoomsChamonix::class)->findAll();
        $hotelChamonix = $this->entityManager->getRepository(Hotel::class)->findBy(array('name'=>'Hypnos Chamonix'));

        return $this->render('chamonix/booking_chamonix/index.html.twig', 
        [   
            'roomChamonix' => $roomChamonix,
            'hotelChamonix' => $hotelChamonix,
            'bookingChamonixForm' => $bookingForm->createView(),
        ]);
        
    }
}
