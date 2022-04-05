<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\RoomsTheoule;
use App\Entity\BookingTheoule;
use App\Form\BookingTheouleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingTheouleController extends AbstractController
{
   
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/booking_theoule', name: 'theoule/app_booking_theoule')]
    public function index(Request $request): Response
    {   
        $booking = new BookingTheoule();
        $bookingForm = $this->createForm(BookingTheouleType::class, $booking);
        $bookingForm->handleRequest($request);

        if($bookingForm->isSubmitted() && $bookingForm->isValid()){
            
            $suiteAvailable = $this->entityManager->getRepository(BookingTheoule::class)->findAll();
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
                    return $this->redirectToRoute('theoule/app_booking_theoule') ;  
            }
        }
    
        $this->entityManager->persist($booking);
        $this->entityManager->flush();
                
        return $this->redirectToRoute('theoule/app_booking_show_theoule', ['id' => $booking->getId()]);
        }

        $roomTheoule = $this->entityManager->getRepository(RoomsTheoule::class)->findAll();
        $hotelTheoule = $this->entityManager->getRepository(Hotel::class)->findBy(array('name'=>'Hypnos Theoule'));

        return $this->render('theoule/booking_theoule/index.html.twig', 
        [   
            'roomTheoule' => $roomTheoule,
            'hotelTheoule' => $hotelTheoule,
            'bookingTheouleForm' => $bookingForm->createView(),
        ]);
        
    }
}
