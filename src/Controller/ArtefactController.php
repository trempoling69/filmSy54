<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\TypeArtefact;
use App\Entity\Artefact;
use App\Repository\ArtefactRepository;

class ArtefactController extends AbstractController
{
    #[Route('/artefact', name: 'app_artefact')]
    public function index(): Response
    {
        return $this->render('artefact/index.html.twig', [
            'controller_name' => 'ArtefactController',
        ]);
    }

    #[Route('/artefact/creerartefact')]
    public function creerArtefact(EntityManagerInterface $doctrine) : Response {
        $type = $doctrine -> getRepository(TypeArtefact::class)
        ->find(rand(1,5));

        $artefact = new Artefact();
        $artefact->setNom('Artefact_'.rand(0,99))
        ->setDetails('Ceci est un test')
        ->setTypeArtefact($type);

        $doctrine->persist($artefact);
        $doctrine->flush();

        $fonction = 'creerArtefact';
        $message = 'nom artefact :'.$artefact->getNom().'    type artefact :'.$artefact->getTypeArtefact()->getNom();
        return $this->render('first_page/exempleRender.html.twig', ['fonction' => $fonction, 'message' => $message]);
      
    }
    #[Route('/artefact/showallartefacts')]
    public function showAllArtefacts(ArtefactRepository $repo){
        $artefacts = $repo -> findAll();
        $aff = '';
        foreach ($artefacts as $artefact){
            $aff .= $artefact->getId().'nom :'.$artefact->getNom().'details : '.$artefact->getDetails().
            'type :'.$artefact->getTypeArtefact()->getNom().
            '<br/>';
        }
        $fonction = 'showAllArtefacts';
        return $this->render('first_page/exempleRender.html.twig', ['fonction' => $fonction, 'message' => $aff]);
    }
}