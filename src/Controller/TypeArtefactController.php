<?php

namespace App\Controller;

use App\Entity\TypeArtefact;
use App\Form\TypeArtefactType;
use App\Repository\TypeArtefactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/type/artefact')]
class TypeArtefactController extends AbstractController
{
    #[Route('/', name: 'app_type_artefact_index', methods: ['GET'])]
    public function index(TypeArtefactRepository $typeArtefactRepository): Response
    {
        return $this->render('type_artefact/index.html.twig', [
            'type_artefacts' => $typeArtefactRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_artefact_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TypeArtefactRepository $typeArtefactRepository): Response
    {
        $typeArtefact = new TypeArtefact();
        $form = $this->createForm(TypeArtefactType::class, $typeArtefact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeArtefactRepository->save($typeArtefact, true);

            return $this->redirectToRoute('app_type_artefact_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_artefact/new.html.twig', [
            'type_artefact' => $typeArtefact,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_artefact_show', methods: ['GET'])]
    public function show(TypeArtefact $typeArtefact): Response
    {
        return $this->render('type_artefact/show.html.twig', [
            'type_artefact' => $typeArtefact,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_artefact_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeArtefact $typeArtefact, TypeArtefactRepository $typeArtefactRepository): Response
    {
        $form = $this->createForm(TypeArtefactType::class, $typeArtefact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeArtefactRepository->save($typeArtefact, true);

            return $this->redirectToRoute('app_type_artefact_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_artefact/edit.html.twig', [
            'type_artefact' => $typeArtefact,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_artefact_delete', methods: ['POST'])]
    public function delete(Request $request, TypeArtefact $typeArtefact, TypeArtefactRepository $typeArtefactRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeArtefact->getId(), $request->request->get('_token'))) {
            $typeArtefactRepository->remove($typeArtefact, true);
        }

        return $this->redirectToRoute('app_type_artefact_index', [], Response::HTTP_SEE_OTHER);
    }
}
