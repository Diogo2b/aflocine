<?php

// src/Controller/SeanceController.php

namespace App\Controller;

use App\Repository\SeanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeanceController extends AbstractController
{
    #[Route('/seances', name: 'seance_index')]
    public function index(SeanceRepository $seanceRepository): Response
    {
        // Busca as sessões do banco de dados
        $seances = $seanceRepository->findAll(); // Substitua por sua própria lógica de busca

        return $this->render('seance/index.html.twig', [
            'seances' => $seances,
        ]);
    }
}
