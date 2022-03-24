<?php

namespace App\Controller\Admin;

use App\Entity\Hotel;
use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ) {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(UsersCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('HYPNOS hôtels');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Utilisateur');
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-user', Users::class);

        yield MenuItem::section('Hotel');
        yield MenuItem::linkToCrud('Hotel', 'fas fa-hotel', Hotel::class);
    }
}
