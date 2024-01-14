<?php

namespace App\Controller;

use App\Entity\Tattoo;
use App\Form\TattooType;
use App\Repository\TattooRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tattoo')]
class TattooController extends AbstractController
{
    #[Route('/', name: 'app_tattoo_index', methods: ['GET'])]
    public function index(TattooRepository $tattooRepository): Response
    {
        return $this->render('tattoo/index.html.twig', [
            'tattoos' => $tattooRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tattoo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tattoo = new Tattoo();
        $form = $this->createForm(TattooType::class, $tattoo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tattoo);
            $entityManager->flush();

            return $this->redirectToRoute('app_tattoo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tattoo/new.html.twig', [
            'tattoo' => $tattoo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tattoo_show', methods: ['GET'])]
    public function show(Tattoo $tattoo): Response
    {
        return $this->render('tattoo/show.html.twig', [
            'tattoo' => $tattoo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tattoo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tattoo $tattoo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TattooType::class, $tattoo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tattoo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tattoo/edit.html.twig', [
            'tattoo' => $tattoo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tattoo_delete', methods: ['POST'])]
    public function delete(Request $request, Tattoo $tattoo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $tattoo->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tattoo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tattoo_index', [], Response::HTTP_SEE_OTHER);
    }
}
