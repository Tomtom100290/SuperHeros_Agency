<?php

namespace App\Controller;

use App\Entity\SuperHeros;
use App\Form\SuperHerosType;
use App\Repository\SuperHerosRepository;
use App\Repository\VillesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/super/heros')]
final class SuperHerosController extends AbstractController
{
    #[Route(name: 'app_super_heros_index', methods: ['GET'])]
    public function index(SuperHerosRepository $superHerosRepository, VillesRepository $villesRepository): Response
    {
        dd($villesRepository->findAll());
        return $this->render('super_heros/index.html.twig', [
            'super_heros' => $superHerosRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_super_heros_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $superHero = new SuperHeros();
        $form = $this->createForm(SuperHerosType::class, $superHero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($superHero);
            $entityManager->flush();

            return $this->redirectToRoute('app_super_heros_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('super_heros/new.html.twig', [
            'super_hero' => $superHero,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_super_heros_show', methods: ['GET'])]
    public function show(SuperHeros $superHero): Response
    {
        return $this->render('super_heros/show.html.twig', [
            'super_hero' => $superHero,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_super_heros_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SuperHeros $superHero, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SuperHerosType::class, $superHero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_super_heros_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('super_heros/edit.html.twig', [
            'super_hero' => $superHero,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_super_heros_delete', methods: ['POST'])]
    public function delete(Request $request, SuperHeros $superHero, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $superHero->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($superHero);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_super_heros_index', [], Response::HTTP_SEE_OTHER);
    }
}
