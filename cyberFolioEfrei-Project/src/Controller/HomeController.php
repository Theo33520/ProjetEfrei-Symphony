<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\UserEntity;
use App\Repository\UserEntityRepository;
use Doctrine\ORM\EntityManagerInterface;



class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/login', name: 'app_login', methods: ['POST'])]
    public function login(Request $request, UserEntityRepository $userEntityRepository, EntityManagerInterface $entityManager): Response
    {
        $username = $request->request->get('username');
        $userEntity = $userEntityRepository->findOneBy(['email' => $username]);
        $error = null;

        if ($userEntity) {
            if ($userEntity->getPassword() === $request->request->get('password')) {
                return $this->redirectToRoute('app_user_show', ['id' => $userEntity->getId()]);
            }
            return new Response('Invalid password');
        }
        return $this->redirectToRoute('app_user_new');

}


}