<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController

{



    #[Route('/', name: 'app_home')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = $request->getSession();
        $user = null;
        $id = $session->get('id');

        /*Recuperer les latititudes et longitudes pour les marker du map */
        $event = $entityManager->getRepository(Event::class)->findAll();
        $responseData = [];
        foreach ($event as $events ) {
            $responseData[] = [
                'long' => $events->getLongitude(),
                'alt'=>$events->getLatitude(),
                'image'=>$events->getId()

            ];
        }
        /*    **************     */

        /*Recuperer les events available tonight  */
      if( $entityManager->getRepository(Event::class)->tonight())
                 $available_tonight = $entityManager->getRepository(Event::class)->tonight()->getId();
    else
                  $available_tonight = 1;
     if( $entityManager->getRepository(Event::class)->thisWeek())
                  $available_thisWeek = $entityManager->getRepository(Event::class)->thisWeek()->getId();
     else
                   $available_thisWeek = 2;
     if( $entityManager->getRepository(Event::class)->NextWeek())
                   $available_NextWeek = $entityManager->getRepository(Event::class)->NextWeek()->getId();
      else
                    $available_NextWeek = 3;
       
       


       /*   ************* */



        if (isset($id)) {
            $user = $entityManager->getRepository(User::class)->find($id);
        }
        return $this->render('home/index.html.twig', [
             'user' => $user,
            'event'=>$responseData,
            'tonight'=>$available_tonight,
            'thisWeek'=>$available_thisWeek,
            'NextWeek'=> $available_NextWeek


        ]);
    }
    
  
}
