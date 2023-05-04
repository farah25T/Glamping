<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventPageController extends AbstractController
{
    #[Route('/event/page', name: 'app_event_page')]
    public function index(): Response
    {
        
        return $this->render('event_page/index.html.twig', [
            'controller_name' => 'EventPageController',
        ]);
    }
}
