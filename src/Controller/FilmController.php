<?php

namespace App\Controller;

use App\Entity\Film;
use App\Entity\Plan;
use App\Form\FilmType;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    #[Route('/film', name: 'app_film')]
    public function index(): Response
    {
        return $this->render('film/index.html.twig', [
            'controller_name' => 'FilmController',
        ]);
    }
    #[Route('/film/democreatefilm', name: 'demo_create_film')]
    public function demoCreateFilm(EntityManagerInterface $doctrine): Response
    {
        $film = new Film();
        $film->setNom('Un beau film')->setPitch('Je suis le pitch du film');
        $doctrine->persist($film);
        $doctrine->flush();
        $nomDemo = 'demoCreateFilm';
        $id = $film->getId();
        $nom = $film->getNom();
        return $this->render('film/democreatefilm.html.twig', compact('nomDemo', 'id', 'nom'));
    }

    #[Route('/film/showall', name: 'show_all')]
    public function showAllFilm(FilmRepository $repo): Response
    {
        $films = $repo->findAll();
        $plans = [];
        foreach ($films as $film) {
            $plans[$film->getId()] = count($film->getPlans());
        }
        $nomDemo = 'showAllFilm';
        return $this->render('film/showall.html.twig', compact('nomDemo', 'films', 'plans'));
    }

    #[Route('/film/show/{id}', name: 'show_one')]
    public function showFilm(FilmRepository $repo, Plan $plan, ?int $id = null): Response
    {
        $film = $repo->find($id);
        $nomDemo = 'showFilm';
        $nom = $film->getNom();
        $id = $film->getId();
        $pitch = $film->getPitch();
        $plans = $film->getPlans();
        $refs = [];
        foreach($plans as $plan){
            $refs[] = $plan->getReference();
        }

        return $this->render('film/filmshow.html.twig', compact('nomDemo', 'nom', 'id', 'pitch', 'refs'));
    }

    #[Route('/film/editfilm/{id}', name : 'edit_film')]
    public function editFilm(Request $request, EntityManagerInterface $doctrine,?int $id = null){
        if ($id) {
            $film = $doctrine->getRepository(Film::class)->find($id);
            if (is_null($film)) {
                #RETOURNER PAS DE FILMS
            }
        } else {
            $film = new Film();
        }
        
        $form = $this->createForm(FilmType::class, $film);

        return $this->render('film/edit_film.html.twig', ['nomDemo' => 'Ajouter un film', 'form' => $form->createView(),]);
    }
}