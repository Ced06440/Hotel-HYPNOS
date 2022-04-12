<?php

namespace App\Controller;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MessageController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/message', name: 'app_message')]
    public function index(): Response
    {
        $message = $this->entityManager->getRepository(Contact::class)->findAll();
        return $this->render('message/index.html.twig', [
            
            'message' => $message,
        ]);
    }

    #[Route('/compte/delete/contact{id}', name: 'app_account_delete_contact')]

    public function delete (Contact $contact)
    {
        $deleteContact = $this->entityManager;
        $deleteContact->remove($contact);
        $deleteContact->flush();

        return $this->render('message/index.html.twig');
    }
}
