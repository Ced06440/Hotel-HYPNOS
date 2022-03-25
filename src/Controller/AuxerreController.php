<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\RoomsAuxerre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuxerreController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/auxerre', name: 'app_auxerre')]
    public function index(): Response
    {
        $roomAuxerre = $this->entityManager->getRepository(RoomsAuxerre::class)->findAll();
        $hotelAuxerre = $this->entityManager->getRepository(Hotel::class)->findBy(array('name'=>'Hypnos Auxerre'));
        
        return $this->render('auxerre/index.html.twig', [

            'roomAuxerre' => $roomAuxerre,
            'hotelAuxerre' => $hotelAuxerre
        ]);
    }
}
