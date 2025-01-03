<?php

namespace App\Controller;

use App\Entity\ProfileEntity;
use App\Form\ProfileEntityType;
use App\Repository\ProfileEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/profile')]
final class ProfileController extends AbstractController
{
    #[Route(name: 'app_profile_index', methods: ['GET'])]
    public function index(ProfileEntityRepository $profileEntityRepository): Response
    {
        return $this->render('profile/index.html.twig', [
            'profile_entities' => $profileEntityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_profile_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $profileEntity = new ProfileEntity();
        $form = $this->createForm(ProfileEntityType::class, $profileEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($profileEntity);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profile/new.html.twig', [
            'profile_entity' => $profileEntity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_profile_show', methods: ['GET'])]
    public function show(ProfileEntity $profileEntity): Response
    {
        return $this->render('profile/show.html.twig', [
            'profile_entity' => $profileEntity,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProfileEntity $profileEntity, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProfileEntityType::class, $profileEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profile/edit.html.twig', [
            'profile_entity' => $profileEntity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_profile_delete', methods: ['POST'])]
    public function delete(Request $request, ProfileEntity $profileEntity, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$profileEntity->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($profileEntity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_profile_index', [], Response::HTTP_SEE_OTHER);
    }
}
