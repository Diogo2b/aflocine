<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FilmRepository;
use Symfony\Component\HttpFoundation\Response;

class FilmController extends AbstractController
{
    #[Route('/film', name: 'app_film')]
    public function index(FilmRepository $filmRepository)
    {
        $films = $filmRepository->findAll();

        return $this->render('film/index.html.twig', [
            'controller_name' => 'FilmController',
            'films' => $films,
        ]);
    }
    /**
     * @Route("/test-film", name="test_film")
     */
    public function test()
    {
        return new Response('Test film controller');
    }
}
