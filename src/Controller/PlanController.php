<?php

namespace App\Controller;

use App\Entity\Effet;
use App\Entity\Plan;
use App\Form\PlanType;
use App\Repository\PlanRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class PlanController extends AbstractController
{
    #[Route('/plan', name: 'app_plan')]
    public function index(): Response
    {
        return $this->render('plan/index.html.twig', [
            'controller_name' => 'PlanController',
        ]);
    }

    #[Route('/plan/democreerplan', name: 'demo_creer_plan')]
    public function demoCreerPlan(ManagerRegistry $doctrine): Response
    {
        $effet = $doctrine->getRepository(Effet::class)
            ->find(rand(1, 4));
        $entityManager = $doctrine->getManager();
        $number = random_int(1, 1000);
        $plan = new Plan();
        $plan->setReference("pl_$number");
        $plan->setDuree($number);
        $plan->setEchelle("1/$number");
        $plan->setDialogues("Voici les dialogues de pl_$number");
        $plan->setEffet($effet);
        $entityManager->persist($plan);
        $entityManager->flush();

        return new Response(
            '<html><body><p>PlanDemo.creerPlan():' . $plan->getId() . '</p></body></html>'
        );
    }
    #[Route('/plan/demoshowplan_1/{id}')]
    public function demoShowPlan_v1(PlanRepository $repo, $id): Response
    {
        $plan = $repo->find($id);

        return new Response(
            '<html><body><p>DemoShowPlan_v1():' . $plan->getId() . 'Reference:' . $plan->getReference() . '<br/>Dialogues:' . $plan->getDialogues() . '</p></body></html>'
        );
    }
    #[Route('/plan/demoshowplan/{id}', name: 'demo_show_plan')]
    public function demoShowPlan(Plan $plan): Response
    {
        $arr = '';
        $artefacts = $plan->getArtefacts();
        foreach ($artefacts as $artefact) {
            $arr .= 'nom :' . $artefact->getNom() . 'type : ' . $artefact->getTypeArtefact()->getNom();
        }
        return new Response(
            '<html><body><p>DemoShowPlan_v1():' . $plan->getId() . 'Reference:' . $plan->getReference() . '<br/>Dialogues:' . $plan->getDialogues() . '<br/>artefact : ' . $arr . '</p></body></html>'
        );
    }
    #[Route('/plan/showallplans', name: 'plan_show_plans')]
    public function showAllPlans(PlanRepository $repo)
    {
        $plans = $repo->findAll();
        $aff = '';
        $arr = '';
        foreach ($plans as $plan) {
            $allartefact = $plan->getArtefacts();
            foreach ($allartefact as $artefact) {
                $arr .= 'nom :' . $artefact->getNom() . 'type : ' . $artefact->getTypeArtefact()->getNom();
            }
            $aff .= $plan->getId() . 'reference :' . $plan->getReference() . 'duree : ' . $plan->getDuree() . 'echelle :' . $plan->getEchelle() . 'dialogue :' . $plan->getDialogues() .
                'effet :' . $plan->getEffet()?->getEffet() . 'artefacts :' . $arr .
                '<br/>';
        }
        return new Response(
            '<html><body><p>PlanDemo.creerPlan():' . $aff . '</p></body></html>'
        );
    }
    #[Route('/plan/demoupdatedialogueplan/{id}')]
    public function demoUpdateDialoguePlan(EntityManagerInterface $doctrine, Plan $plan)
    {
        $plan->setDialogues("Dialogues_modifiés : {$plan->getDialogues()}");
        $doctrine->flush();
        return $this->redirectToRoute('demo_show_plan', ['id' => $plan->getId()]);
    }
    #[Route('/plan/demoshowmodifiedplans')]
    public function ShowModifedPlans(PlanRepository $repo): Response
    {
        $plans = $repo->findAllModifiedPlan();
        $aff = '';
        foreach ($plans as $plan) {
            $aff .= 'Id :' . $plan->getId() . 'Reference : ' . $plan->getReference() . 'Dialogues : ' . $plan->getDialogues() . '<br/>';

            $fonction = "ShowModifedPlans";
        }
        return $this->render('first_page/exempleRender.html.twig', ['fonction' => $fonction, 'message' => $aff]);
    }
    #[Route('/plan/addplan/{id}', name: 'plan_add_plan')]
    public function addPlan(Request $request, EntityManagerInterface $doctrine, ?int $id = null)
    {
        if ($id) {
            $plan = $doctrine->getRepository(Plan::class)->find($id);
            if (is_null($plan)) {
                return $this->render('error.html.twig', [
                    'nomDemo' => 'Ajouter un plan',
                    'error_message' => "le plan $id n'existe pas...",
                    'redir' => [
                        'message' => 'créer un nouveau plan ?',
                        'route' => 'plan_add_plan',
                    ],
                ]);
            }
        } else {
            $plan = new Plan();
        }
        $form =  $this->createForm(PlanType::class, $plan);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $doctrine->persist($plan);
            $doctrine->flush();
            return $this->redirectToRoute('plan_show_plans');
        }
        return $this->render('plan/add_plan.html.twig', ['nomDemo' => 'AJouter un plan', 'form' => $form->createView(),]);
    }
}
