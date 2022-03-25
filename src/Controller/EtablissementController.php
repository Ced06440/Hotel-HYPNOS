<?php

namespace App\Controller;

use App\Entity\Hotel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtablissementController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/etablissement', name: 'app_etablissement')]
    public function index(): Response
    {
        $hotelChamonix = $this->entityManager->getRepository(Hotel::class)->findBy(array('name'=>'Hypnos Chamonix'));
        $hotelAuxerre = $this->entityManager->getRepository(Hotel::class)->findBy(array('name'=>'Hypnos Auxerre'));
        $hotelCannes = $this->entityManager->getRepository(Hotel::class)->findBy(array('name'=>'Hypnos Cannes'));
        $hotelMandelieu = $this->entityManager->getRepository(Hotel::class)->findBy(array('name'=>'Hypnos Mandelieu'));
        $hotelNice = $this->entityManager->getRepository(Hotel::class)->findBy(array('name'=>'Hypnos Nice'));
        $hotelParis = $this->entityManager->getRepository(Hotel::class)->findBy(array('name'=>'Hypnos Paris'));
        $hotelTheoule = $this->entityManager->getRepository(Hotel::class)->findBy(array('name'=>'Hypnos Theoule'));

        return $this->render('etablissement/index.html.twig',[

        'hotelChamonix' => $hotelChamonix,
        'hotelAuxerre' => $hotelAuxerre,
        'hotelCannes' => $hotelCannes,
        'hotelMandelieu' => $hotelMandelieu,
        'hotelNice'=> $hotelNice,
        'hotelParis'=> $hotelParis,
        'hotelTheoule' => $hotelTheoule,

        ]);
    }
}
