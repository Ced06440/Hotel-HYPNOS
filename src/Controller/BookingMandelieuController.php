<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\RoomsMandelieu;
use App\Entity\BookingMandelieu;
use App\Form\BookingMandelieuType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingMandelieuController extends AbstractController
{
    
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/booking_mandelieu', name: 'mandelieu/app_booking_mandelieu')]
    public function index(Request $request): Response
    {   
        $booking = new BookingMandelieu();
        $bookingForm = $this->createForm(BookingMandelieuType::class, $booking);
        $bookingForm->handleRequest($request);

        if($bookingForm->isSubmitted() && $bookingForm->isValid()){
            
            $suiteAvailable = $this->entityManager->getRepository(BookingMandelieu::class)->findAll();
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
                    return $this->redirectToRoute('mandelieu/app_booking_mandelieu') ;  
            }
        }
    
        $this->entityManager->persist($booking);
        $this->entityManager->flush();
                
        return $this->redirectToRoute('mandelieu/app_booking_show_mandelieu', ['id' => $booking->getId()]);
        }

        $roomMandelieu = $this->entityManager->getRepository(RoomsMandelieu::class)->findAll();
        $hotelMandelieu = $this->entityManager->getRepository(Hotel::class)->findBy(array('name'=>'Hypnos Mandelieu'));

        return $this->render('mandelieu/booking_mandelieu/index.html.twig', 
        [   
            'roomMandelieu' => $roomMandelieu,
            'hotelMandelieu' => $hotelMandelieu,
            'bookingMandelieuForm' => $bookingForm->createView(),
        ]);
        
    }
}
