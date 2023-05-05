<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventPageController extends AbstractController
{


    private $em;
	public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }


    #[Route('/eventpage', name: 'app_event_page')]
    public function index(): Response
    {
        return $this->render('event_page/index.html.twig', [
            'controller_name' => 'EventPageController',
        ]);
    }


    #[Route('/event/{id}', methods:['GET'], name: 'event_page')]
    public function show($id): Response
    {
        $repository = $this->em->getRepository('App\Entity\Event');

        $event = $repository->find($id);
        
        return $this->render('event_page/index.html.twig', [
            'event' => $event
        ]);
    }
}
