<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\RoomsParis;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ParisController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/paris', name: 'app_paris')]
    public function index(): Response
    {
        $roomParis = $this->entityManager->getRepository(RoomsParis::class)->findAll();
        $hotelParis = $this->entityManager->getRepository(Hotel::class)->findBy(array('name'=>'Hypnos Paris'));
        
        return $this->render('paris/index.html.twig', [

            'roomParis' => $roomParis,
            'hotelParis'=> $hotelParis,
        ]);
    }
}
