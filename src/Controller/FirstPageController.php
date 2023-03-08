<?php

namespace App\Controller;

use App\Entity\Effet;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FirstPageController
extends AbstractController
{
    // TODO : add action
    #[Route('/firstpage/hasardannot/{nb}')]
    public function hasardAnnot(?int $nb=0): Response
    {
        $numbers = [];
        for($i=0; $i<$nb; $i++){
            $numbers[] = random_int(100, 200);
        }
        $message = 'Les nombres :';
        $nomDemo = 'hasardAnnot';
        return $this->render('first_page/hasard_annot.html.twig', compact('numbers', 'message', 'nomDemo'));
    }
    #[Route('/', name: 'hasard')]
    public function hasard(): Response
    {
        $number = mt_rand(200, 300);
        $message = 'Je suis un nombre complètement aléatoire';
        $nomDemo = 'hasard.';
        return $this->render('first_page/hasard.html.twig', compact('number', 'message', 'nomDemo'));
    }

    #[Route('/firstpage/demoshoweffet/{id}')]
    public function demoshoweffet(Effet $effet): Response
    {
        $plans = $effet->getPlans();
        $aff = '';
        foreach ($plans as $plan) {
            $aff .= $plan->getId() . 'reference :' . $plan->getReference() . 'duree : ' . $plan->getDuree() . 'echelle :' . $plan->getEchelle() . 'dialogue :' . $plan->getDialogues() .
                'effet :' . $plan->getEffet()?->getEffet() .
                '<br/>';
        }
        return new Response(
            '<html><body><p>DemoShoweffet():' . $effet->getEffet() . '<br/> plan qui utilise cet effet :' . $aff . '</p></body></html>'
        );
    }
}