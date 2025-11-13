<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/calories')]
class CaloriesController extends AbstractController
{
    #[Route('', name: 'app_calories_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('calories/index.html.twig', []);
    }
}
