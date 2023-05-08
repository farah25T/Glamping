<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Event;
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





    #[Route('/event_booked', name: 'event_booked')]
    public function booked(EntityManagerInterface $entityManager, SessionInterface $session): JsonResponse
    {
        $userIsFound = $entityManager->getRepository(User::class)->findOneById($session->get('id'));

        if (!$userIsFound) {
            throw $this->createNotFoundException('User not found');
        }
        $bookingRepository = $entityManager->getRepository(Booking::class)->findBy((['id_user' => $userIsFound]));



        $bookedEventsArray = [];
        foreach ($bookingRepository as $event) {
            $bookedEventsArray[] = [
                'name' => $entityManager->getRepository(Event::class)->findOneBy((['id' =>  $event->getIdEvent()->getId()]))->getName(),
                'image'=>$entityManager->getRepository(Event::class)->findOneBy((['id' =>  $event->getIdEvent()->getId()]))->getName(),

            ];
        }

        return $this->json($bookedEventsArray);

    }




}
