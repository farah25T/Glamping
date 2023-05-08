<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class BookingController extends AbstractController
{
    #[Route('/Booking/{event}', name: 'booking_app')]
    public function index(Request $request, EntityManagerInterface $entityManager,$event): Response
    {   
        $session = $request->getSession();
        $user = null;
        
        $id = $session->get('id');
        if(!isset($id)){
            return $this->redirectToRoute('app_home');
        }
        if (isset($id)) {
            $user = $entityManager->getRepository(User::class)->find($id);
            $event = $entityManager->getRepository(Event::class)->find($event);
        }
        return $this->render('booking/index.html.twig', [
            'user' => $user,
            'event'=>$event
        ]);
    }
}
