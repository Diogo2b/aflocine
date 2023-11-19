<?php

// src/Controller/HomeController.php

namespace App\Controller;

use App\Repository\FilmRepository;
use App\Repository\SeanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(FilmRepository $filmRepository, SeanceRepository $seanceRepository): Response
    {
        // Busca os filmes da semana do banco de dados
        // Substitua 'findFilmsForTheWeek' pelo método apropriado do seu repositório
        $films_semaine = $filmRepository->findFilmsForTheWeek();

        // Busca as sessões do dia
        $seances_du_jour = $seanceRepository->findSeancesForToday();

        // Renderiza o template e passa as variáveis necessárias
        return $this->render('home/index.html.twig', [
            'films_semaine' => $films_semaine,
            'seances_du_jour' => $seances_du_jour,
        ]);
    }
}
