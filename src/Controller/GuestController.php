<?php

namespace App\Controller;

use App\Entity\Guest;
use App\Form\GuestType;
use App\Repository\GuestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/guest')]
class GuestController extends AbstractController
{
    #[Route('/', name: 'app_guest_index', methods: ['GET'])]
    public function index(GuestRepository $guestRepository): Response
    {
        return $this->render('guest/index.html.twig', [
            'guests' => $guestRepository->findAll(),
        ]);
    }

    #[Route(path: '/calendar', name: "app_guest_calendar", methods: ['GET'])]
    public function calendar(): Response
    {
        return $this->render('guest/calendar.html.twig');
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/new', name: 'app_guest_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $guest = new Guest();
        $form = $this->createForm(GuestType::class, $guest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($guest);
            $entityManager->flush();

            return $this->redirectToRoute('app_guest_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('guest/new.html.twig', [
            'guest' => $guest,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_guest_show', methods: ['GET'])]
    public function show(Guest $guest): Response
    {
        return $this->render('guest/show.html.twig', [
            'guest' => $guest,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'app_guest_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Guest $guest, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GuestType::class, $guest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_guest_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('guest/edit.html.twig', [
            'guest' => $guest,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_guest_delete', methods: ['POST'])]
    public function delete(Request $request, Guest $guest, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $guest->getId(), $request->request->get('_token'))) {
            $entityManager->remove($guest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_guest_index', [], Response::HTTP_SEE_OTHER);
    }
}
