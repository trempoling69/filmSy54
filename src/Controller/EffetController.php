<?php

namespace App\Controller;

use App\Entity\Effet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class EffetController extends AbstractController
{
    #[Route('/effet', name: 'app_effet')]
    public function index(): Response
    {
        return $this->render('effet/index.html.twig', [
            'controller_name' => 'EffetController',
        ]);
    }
    #[Route('/effet/create', name: 'create_effet')]
    public function createEffet(Request $request, EntityManagerInterface $doctrine): Response
    {
        $effet = new Effet();
        $effet->setEffet('Je suis un effet');
        $formBuilder = $this->createFormBuilder($effet);
        $formBuilder->add('effet', TextType::class, ['required'=>true])
                ->add('save', SubmitType::class, ['label'=>'Enregistrer']);
        $form = $formBuilder->getForm();
        $form->handleRequest($request);
        if( $form -> isSubmitted()){
            $doctrine->persist($effet);
            $doctrine->flush();
            return $this->redirectToRoute('create_effet');
        }
       $form = $form->createView();
        $nomDemo = 'create Effet function';
        return $this->render('effet/createEffet.html.twig',compact('nomDemo', 'form'));
    }
}