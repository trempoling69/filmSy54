<?php

namespace App\Controller;

use App\Entity\Plan;
use App\Repository\PlanRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
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
    #[Route('/plan/demoshowplan_1/{id}')]
    public function demoShowPlan_v1(PlanRepository $repo, $id) : Response
    {
        $plan = $repo->find($id);

        return new Response(
            '<html><body><p>DemoShowPlan_v1():'.$plan->getId().'Reference:'.$plan->getReference().'<br/>Dialogues:'.$plan->getDialogues().'</p></body></html>'
        );
    }
    #[Route('/plan/demoshowplan/{id}', name:'demo_show_plan')]
    public function demoShowPlan(Plan $plan) : Response
    {
        return new Response(
            '<html><body><p>DemoShowPlan_v1():'.$plan->getId().'Reference:'.$plan->getReference().'<br/>Dialogues:'.$plan->getDialogues().'</p></body></html>'
        );
    }
    #[Route('/plan/demoupdatedialogueplan/{id}')]
    public function demoUpdateDialoguePlan(EntityManagerInterface $doctrine, Plan $plan)
    {
        $plan -> setDialogues("Dialogues_modifiés : {$plan->getDialogues()}");
        $doctrine -> flush();
        return $this -> redirectToRoute('demo_show_plan', ['id'=>$plan->getId()]);
    }
    #[Route('/plan/demoshowmodifiedplans')]
    public function ShowModifedPlans(PlanRepository $repo) : Response
    {
        $plans = $repo->findAllModifiedPlan();
        $aff = '';
        foreach ($plans as $plan){
            $aff .= 'Id :'.$plan->getId().'Reference : '.$plan->getReference().'Dialogues : '.$plan->getDialogues().'<br/>';

            $fonction = "ShowModifedPlans";
            
        }
        return $this->render('first_page/exempleRender.html.twig', ['fonction' => $fonction, 'message' => $aff]);
    }
}