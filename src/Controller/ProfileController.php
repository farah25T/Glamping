<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = $request->getSession();
        $id = $session->get('id');
        if (!isset($id)) {
            return ($this->redirectToRoute('app_authentication'));
        }
        $user = $entityManager->getRepository(User::class)->find($id);
        return $this->render('profile/index.html.twig',['user'=>$user]);
    }
}
