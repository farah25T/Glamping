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
        foreach ($event as $events) {
            $responseData[] = [
                'long' => $events->getLongitude(),
                'alt' => $events->getLatitude(),
                'image' => $events->getId()

            ];
        }
        $best_2021=22;
        $available_tonight = 1;
        $available_thisWeek = 2;
        $available_NextWeek = 3;
        $best_2023=25;
        $best_2022=18;

        /*    **************     */

        /*Recuperer les events available tonight  */
        if ($entityManager->getRepository(Event::class)->tonight())
            $available_tonight = $entityManager->getRepository(Event::class)->tonight()->getId();

        if ($entityManager->getRepository(Event::class)->thisWeek())
            $available_thisWeek = $entityManager->getRepository(Event::class)->thisWeek()->getId();

        if ($entityManager->getRepository(Event::class)->NextWeek())
            $available_NextWeek = $entityManager->getRepository(Event::class)->NextWeek()->getId();

// Find the top by date

            if ($entityManager->getRepository(Event::class)->findTopEventOfYear2021())
            $best_2021 = $entityManager->getRepository(Event::class)->findTopEventOfYear2021()->getId();


            if ($entityManager->getRepository(Event::class)->findTopEventOfYear2022())
            $best_2022 = $entityManager->getRepository(Event::class)->findTopEventOfYear2022()->getId();

            if ($entityManager->getRepository(Event::class)->findTopEventOfYear2023())
            $best_2023 = $entityManager->getRepository(Event::class)->findTopEventOfYear2023()->getId();




        /*   ************* */

        $maxGuests = $entityManager->getRepository(Event::class)->findMaxNbrGuests();


        if (isset($id)) {
            $user = $entityManager->getRepository(User::class)->find($id);
        }
        return $this->render('home/index.html.twig', [
            'user' => $user,
            'event' => $responseData,
            'tonight' => $available_tonight,
            'thisWeek' => $available_thisWeek,
            'NextWeek' => $available_NextWeek,
            'guests' => $maxGuests,
            'b2023'=>$best_2023,
            'b2021'=>$best_2021,
            'b2022'=>$best_2022




        ]);
    }
}
