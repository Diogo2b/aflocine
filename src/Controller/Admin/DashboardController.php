<?php

namespace App\Controller\Admin;

use App\Entity\Film;
use App\Entity\Reservation;
use App\Entity\Seance;
use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(FilmCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('AfloCine Admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Tableau de Bord', 'fa fa-home');
        yield MenuItem::linkToCrud('Films', 'fas fa-film', Film::class);
        yield MenuItem::linkToCrud('Réservations', 'fas fa-ticket-alt', Reservation::class);
        yield MenuItem::linkToCrud('Séances', 'fas fa-clock', Seance::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-users', Utilisateur::class);
    }
}
