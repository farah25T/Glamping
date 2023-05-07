<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class EventUserController extends AbstractController
{

    #[Route('/event_user', name: 'app_event_user')]
    public function index(EntityManagerInterface $entityManager , SessionInterface $session): Response
    {
        if($session->get('id')==0)
        {
            return ($this->redirectToRoute('app_authentication', ['my_event_page'=>true]));
        }

        $userIsFound = $entityManager->getRepository(User::class)->findOneById($session->get('id'));

        return $this->render('event_user/index.html.twig', [
            'user'=>$userIsFound
        ]);
    }






    #[Route('/event_saved', name: 'event_saved')]
    public function liked(EntityManagerInterface $entityManager, SessionInterface $session): JsonResponse
    {
        $userIsFound = $entityManager->getRepository(User::class)->findOneById($session->get('id'));

        if (!$userIsFound) {
            throw $this->createNotFoundException('User not found');
        }

        $events = $userIsFound->getEvents();


        $responseData = [];
        foreach ($events as $event) {
            $responseData[] = [
                'name' => $event->getName(),

            ];
        }

        return new JsonResponse($responseData);
    }





}
