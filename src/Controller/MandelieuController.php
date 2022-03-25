<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\RoomsMandelieu;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MandelieuController extends AbstractController
{
    
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    
    #[Route('/mandelieu', name: 'app_mandelieu')]
    public function index(): Response
    {
        $roomMandelieu = $this->entityManager->getRepository(RoomsMandelieu::class)->findAll();
        $hotelMandelieu = $this->entityManager->getRepository(Hotel::class)->findBy(array('name'=>'Hypnos Mandelieu'));
        
        return $this->render('mandelieu/index.html.twig', [

            'roomMandelieu' => $roomMandelieu,
            'hotelMandelieu' => $hotelMandelieu,
        ]);
    }
}
