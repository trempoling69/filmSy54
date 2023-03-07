<?php

namespace App\Controller;

use App\Entity\Plan;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class PlanController extends AbstractController
{
    #[Route('/plan', name: 'app_plan')]
    public function index(): Response
    {
        return $this->render('plan/index.html.twig', [
            'controller_name' => 'PlanController',
        ]);
    }

    #[Route('/plan/democreerplan', name:'demo_creer_plan')]
    public function demoCreerPlan(ManagerRegistry $doctrine): Response
    {
      $entityManager = $doctrine->getManager();
      $number = random_int(1,1000);
      $plan = new Plan();
      $plan -> setReference("pl_$number");
      $plan -> setDuree($number);
      $plan -> setEchelle("1/$number");
      $plan -> setDialogues("Voici les dialogues de pl_$number");
      $entityManager -> persist($plan);
      $entityManager -> flush();

      return new Response(
        '<html><body><p>PlanDemo.creerPlan():'.$plan->getId().'</p></body></html>'
      );
    }
}