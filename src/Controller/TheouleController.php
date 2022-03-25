<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\RoomsTheoule;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TheouleController extends AbstractController
{
    
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    
    #[Route('/theoule', name: 'app_theoule')]
    public function index(): Response
    {
        $roomTheoule = $this->entityManager->getRepository(RoomsTheoule::class)->findAll();
        $hotelTheoule = $this->entityManager->getRepository(Hotel::class)->findBy(array('name'=>'Hypnos Theoule'));
        
        return $this->render('theoule/index.html.twig', [

            'roomTheoule' => $roomTheoule,
            'hotelTheoule' => $hotelTheoule,
        ]);
    }
}
