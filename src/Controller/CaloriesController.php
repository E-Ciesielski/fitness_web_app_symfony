<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/calories')]
class CaloriesController extends AbstractController
{
    #[Route('', name: 'app_calories_index', methods: ['GET'])]
    public function index(#[MapQueryParameter] ?string $date = null): Response
    {
        if($date === null)
        {
            $date = new \DateTimeImmutable("now");
        }
        else
        {
            $date = \DateTimeImmutable::createFromFormat('Y-m-d', $date);
            if($date === false)
            {
                throw $this->createNotFoundException("Date is not valid");
            }
        }

        return $this->render('calories/index.html.twig', [
            'date' => $date->format('Y-m-d'),
        ]);
    }
}
