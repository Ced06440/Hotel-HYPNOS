<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\RoomsNice;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NiceController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    
    #[Route('/nice', name: 'app_nice')]
    public function index(): Response
    {
        $roomNice = $this->entityManager->getRepository(RoomsNice::class)->findAll();
        $hotelNice = $this->entityManager->getRepository(Hotel::class)->findBy(array('name'=>'Hypnos Nice'));
        
        return $this->render('nice/index.html.twig', [

            'roomNice' => $roomNice,
            'hotelNice'=> $hotelNice,
        ]);
    }
}
