<?php

namespace App\Controller;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mime\Message;

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

    #[Route('/compte/delete/message{id}', name: 'app_account_delete_message')]

    public function delete (Message $message)
    {
        $deleteMessage = $this->entityManager;
        $deleteMessage->remove($message);
        $deleteMessage->flush();

        return $this->render('message/index.html.twig');
    }
}
