<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SessionRepository;


class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(SessionRepository $sessionRepository): Response
    {
        return $this->render('accueil/index.html.twig', [
            'sessions' => $sessionRepository->findAll(),
            'controller_name' => 'AccueilController',
        ]);
    }
}
