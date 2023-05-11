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
    public function __construct(
        EntityManagerInterface $em
    ) {

        $this->em = $em;
    }

    #[Route('/catalogue', name: 'app_catalogue_page')]
    public function index(EventRepository $eventRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = $request->getsession();
        $user = null;
        $userid = $session->get('id');
        if (isset($userid)) {
            $user = $this->em->getRepository(User::class)->find($userid);
        }
        $CurrPage = $request->query->getInt('page', 1);
        $Search = null;
        $MinPrice = null;
        $MaxPrice = null;
        $Location = null;
        $Guests = null;
        $Sort = null;
        // $DateDebut = null;
        // $DateFin = null;
        // if($request->query->has('debut')){
        //     $DateDebut = $request->query->get('debut');
        // }
        // if($request->query->has('fin')){
        //     $DateFin = $request->query->get('fin');
        // }
        if ($request->query->has('sort')) {
            $Sort = $request->query->get('sort');
        }
        if ($request->query->has('search')) {
            $Search = $request->query->get('search');
            $Search = str_replace(",", " ", $Search);
            $Search = preg_replace("/[^ \w]+/", "", $Search);
            if( strlen($Search) === 0) $Search = null;
        }
        if ($request->query->has('MinPrice')) {
            $MinPrice = $request->query->getInt('MinPrice', 0);
        }
        if ($request->query->has('MaxPrice')) {
            $MaxPrice = $request->query->getInt('MaxPrice', 0);
        }
        if ($request->query->has('location')) {
            $Location = $request->query->get('location');
            $Location = str_replace(",", " ", $Location);
            $Location = preg_replace("/[^ \w]+/", "", $Location);
            if( strlen($Location) === 0) $Location = null;
        }
        if ($request->query->has('guests')) {
            $Guests = $request->query->getInt('guests', 0);
        }

        $maxGuests = $entityManager->getRepository(Event::class)->findMaxNbrGuests();

        if ($MaxPrice < 0) {
            $MaxPrice = null;
        }
        if ( ( !is_null($MaxPrice) and $MinPrice > $MaxPrice ) or $MinPrice < 0) {
            $MinPrice = null;
        }
        if($Guests < 0 or $Guests < $maxGuests)
        {
            $Guests = null;
        }
        $MaxPageCount = 6;
        $QueryParam = [];
        if(!is_null($Guests)) $QueryParam["guests"] =  $Guests;
        if(!is_null($Search)) $QueryParam["Search"] =  $Search;
        if(!is_null($MinPrice)) $QueryParam["minPrice"] =  $MinPrice;
        if(!is_null($MaxPrice)) $QueryParam["maxPrice"] =  $MaxPrice;
        if(!is_null($Location)) $QueryParam["location"] =  $Location;
        if(!is_null($Sort)) $QueryParam["sort"] =  $Sort;

        $queryB = $eventRepository->GetFilter_SortQueryBuilder($QueryParam);
        $adapter = new QueryAdapter($queryB);
        $pagerFanta = Pagerfanta::createForCurrentPageWithMaxPerPage($adapter, $CurrPage, $MaxPageCount);

        $routeGenerator = function ($page) {
            $path = '/path?page=' . $page;
            return $path;
        };

        $responseData = [];

        foreach ($pagerFanta as $event) {
            $toggled = false;
            if ($user) {
                $users = $event->getUsers();
                foreach ($users as $u) {
                    if ($u->getId() === $user->getId()) {
                        $toggled = true;
                        break;
                    }
                }
            }
            $responseData[] = [
                'name' => $event->getName(),
                'id' => $event->getId(),
                'date_debut' => $event->getDateDebut()->format('Y-m-d'),
                'date_fin' => $event->getDateFin()->format('Y-m-d'),
                'price' => $event->getPrice(),
                'place' => $event->getPlace(),
                'city' => $event->getCity(),
                'latitude' => $event->getLatitude(),
                'longitude' => $event->getLongitude(),
                'toggled' => $toggled,
            ];
        }


        return $this->render('catalogue_page/index.html.twig', [
            'controller_name' => 'CataloguePageController',
            'user' => $user,
            'pager' => $responseData,
            'fanta' => $pagerFanta,
            'guests' => $maxGuests,
            'route' => $routeGenerator,
            'minPrice'=> $MinPrice,
            'maxPrice'=> $MaxPrice,
            'location'=> $Location,
            'guestInput'=> $Guests,
            'search'=> $Search,
        ]);
    }
}
