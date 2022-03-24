<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\RoomsCannes;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CannesController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/cannes', name: 'app_cannes')]
    public function index(): Response
    {
        $roomCannes = $this->entityManager->getRepository(RoomsCannes::class)->findAll();
        
        return $this->render('cannes/index.html.twig', [

            'room' => $roomCannes
        ]);
    }
}
