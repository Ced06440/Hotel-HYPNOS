<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\RoomsChamonix;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChamonixController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/chamonix', name: 'app_chamonix')]
    public function index(): Response
    {
        $roomChamonix = $this->entityManager->getRepository(RoomsChamonix::class)->findAll();
        $hotelChamonix = $this->entityManager->getRepository(Hotel::class)->findBy(array('name'=>'Hypnos Chamonix'));
        
        return $this->render('chamonix/index.html.twig', [

            'roomChamonix' => $roomChamonix,
            'hotelChamonix' =>$hotelChamonix
        ]);
    }
}

