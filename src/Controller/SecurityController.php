<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, AdminUrlGenerator $adminUrlGenerator): Response
    {
        if ($this->getUser()) {
            if ($this->isGranted('ROLE_ADMIN')) {
                // Rediriger vers l'URL du dashboard administrateur
                return $this->redirect($adminUrlGenerator->setDashboard(DashboardController::class)->generateUrl());
            } else {
                // Rediriger les utilisateurs non-admin vers la page d'accueil ou autre
                return $this->redirectToRoute('app_home');
            }
        }

        // Récupérer l'erreur de connexion s'il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();
        // Récupérer le dernier nom d'utilisateur saisi
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Cette méthode peut rester vide, elle sera interceptée par la configuration de sécurité
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
