<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\RoomsNice;
use App\Entity\BookingNice;
use App\Form\BookingNiceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingNiceController extends AbstractController
{
    
    
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/booking_nice', name: 'nice/app_booking_nice')]
    public function index(Request $request): Response
    {   
        $booking = new BookingNice();
        $bookingForm = $this->createForm(BookingNiceType::class, $booking);
        $bookingForm->handleRequest($request);

        if($bookingForm->isSubmitted() && $bookingForm->isValid()){
            
            $suiteAvailable = $this->entityManager->getRepository(BookingNice::class)->findAll();
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
                    return $this->redirectToRoute('nice/app_booking_nice') ;  
            }
        }
    
        $this->entityManager->persist($booking);
        $this->entityManager->flush();
                
        return $this->redirectToRoute('nice/app_booking_show_nice', ['id' => $booking->getId()]);
        }

        $roomNice = $this->entityManager->getRepository(RoomsNice::class)->findAll();
        $hotelNice = $this->entityManager->getRepository(Hotel::class)->findBy(array('name'=>'Hypnos Nice'));

        return $this->render('nice/booking_nice/index.html.twig', 
        [   
            'roomNice' => $roomNice,
            'hotelNice' => $hotelNice,
            'bookingNiceForm' => $bookingForm->createView(),
        ]);
        
    }
}
