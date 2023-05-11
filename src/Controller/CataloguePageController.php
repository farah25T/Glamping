<?php

namespace App\Controller;
use App\Repository\EventRepository;
use App\Entity\Event;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CataloguePageController extends AbstractController
{
    private $em;
	public function __construct(EntityManagerInterface $em
    ){

        $this->em = $em;
    }

    #[Route('/catalogue', name: 'app_catalogue_page')]
    public function index(EventRepository $eventRepository,EntityManagerInterface $entityManager , Request $request ): Response
    {
        $session = $request->getsession();
        $user = null;
        $userid = $session->get('id');
        if (isset($userid)) {
            $user = $this->em->getRepository(User::class)->find($userid);
        }
        $CurrPage = $request->query->getInt('page', 1);
        $MaxPageCount = 6;
        $queryB = $eventRepository->GetFilter_SortQueryBuilder();
        $adapter = new QueryAdapter($queryB);
        $pagerFanta = Pagerfanta::createForCurrentPageWithMaxPerPage($adapter,$CurrPage,$MaxPageCount);
        $maxGuests = $entityManager->getRepository(Event::class)->findMaxNbrGuests();

        $responseData = [];

        foreach($pagerFanta as $event)
        {
            $toggled = false;
            if ($user){
                $users = $event->getUsers();
                foreach ($users as $u) {
                    if ($u->getId() === $user->getId())
                    { 
                        $toggled = true;
                        break;
                    }
                }
            }
            $responseData[] = [
                'name' => $event->getName(),
                'id' => $event->getId(),
                'date_debut'=>$event->getDateDebut()->format('Y-m-d'),
                'date_fin'=>$event->getDateFin()->format('Y-m-d'),
                'price'=>$event->getPrice(),
                'place'=>$event->getPlace(),
                'city' =>$event->getCity(),
                'latitude' =>$event->getLatitude(),
                'longitude' =>$event->getLongitude(),
                'toggled' => $toggled
            ];
        }


        return $this->render('catalogue_page/index.html.twig', [
            'controller_name' => 'CataloguePageController',
            'user' => $user,
            'pager' =>$responseData,
            'fanta' =>$pagerFanta,
            'guests'=>$maxGuests,
        ]);
    }
}