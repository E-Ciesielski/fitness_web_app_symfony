<?php

namespace App\Controller;

use App\Entity\CaloriesLog;
use App\Form\CaloriesLogType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/calories')]
class CaloriesController extends AbstractController
{
    #[Route('', name: 'app_calories_index', methods: ['GET', 'POST'])]
    public function index( Request $request, EntityManagerInterface $em, #[MapQueryParameter] ?string $date = null): Response
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
        $calories = $em->getRepository(CaloriesLog::class)->findBy(['date' => $date]);
        $caloriesLog = new CaloriesLog();

        $form = $this->createForm(CaloriesLogType::class, $caloriesLog);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $caloriesLog->setDate($date);
            $em->persist($caloriesLog);
            $em->flush();
            return $this->redirectToRoute('app_calories_index', ['date' => $date->format('Y-m-d')]);
        }

        $sum = array_reduce($calories, function($carry, $log) { return $carry + $log->getCalories(); }, 0);

        return $this->render('calories/index.html.twig', [
            'date' => $date->format('Y-m-d'),
            'form' => $form,
            'calories' => $calories,
            'caloriesSum' => $sum,
        ]);
    }
}
