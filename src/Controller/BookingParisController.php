<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\RoomsParis;
use App\Entity\BookingParis;
use App\Form\BookingParisType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingParisController extends AbstractController
{
    
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/booking_paris', name: 'paris/app_booking_paris')]
    public function index(Request $request): Response
    {   
        $booking = new BookingParis();
        $bookingForm = $this->createForm(BookingParisType::class, $booking);
        $bookingForm->handleRequest($request);

        if($bookingForm->isSubmitted() && $bookingForm->isValid()){
            
            $suiteAvailable = $this->entityManager->getRepository(BookingParis::class)->findAll();
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
                    $this->addFlash('warning', 'Les dates que vous avez choisies sont déjà prise, pour cette chambre');
                    return $this->redirectToRoute('paris/app_booking_paris') ;  
            }
        }
    
        $this->entityManager->persist($booking);
        $this->entityManager->flush();
                
        return $this->redirectToRoute('paris/app_booking_show_paris', ['id' => $booking->getId()]);
        }

        $roomParis = $this->entityManager->getRepository(RoomsParis::class)->findAll();
        $hotelParis = $this->entityManager->getRepository(Hotel::class)->findBy(array('name'=>'Hypnos Paris'));

        return $this->render('paris/booking_paris/index.html.twig', 
        [   
            'roomParis' => $roomParis,
            'hotelParis' => $hotelParis,
            'bookingParisForm' => $bookingForm->createView(),
        ]);
        
    }
}