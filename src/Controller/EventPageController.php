<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

class EventPageController extends AbstractController
{


    private $em;
	public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }


    #[Route('/event/{id}', methods:['GET'], name: 'app_event_page')]
    public function show($id): Response
    {
        $user = $this->getUser();

        $repository = $this->em->getRepository('App\Entity\Event');
        $event = $repository->find($id);
        
        if (!$event) {
            return $this->redirectToRoute('app_home', [
                'user' => $user
            ]);
        }


        return $this->render('event_page/index.html.twig', [
            'event' => $event,
            'user' => $user
        ]);
  
    }


// #[Route('/event/{id}/like', methods:['POST'], name: 'like_action')]
// public function likeAction($id): JsonResponse
// {


//     $eventrepository = $this->em->getRepository('App\Entity\Event');
//     $event = $eventrepository->find($id);
//     $user = $this->getUser();
    


//     if (!$event) {
//         throw $this->createNotFoundException('Event not found');
//     }

//     $userrepository = $this->em->getRepository('App\Entity\User');
//     $user = $userrepository->find();

    

//     $users = $event->getUsers();

//     $isLiked = false;
// foreach ($users as $u) {
//     if ($u === $user) {
//         $isLiked = true;
//         $user = $u;
//         break;
//     }
// }

// if ($isLiked) {

//      // Unlike the event
//      $event->removeUser($user);
//      $this->em->flush();
 
//      $likeCount = count($likes) - 1;
//      $isLiked = false;

// } else {

//     // Like the event
//     $like = new event_user;
//     $like->setUser($user);
//     $like->setEvent($event);

//     $entityManager->persist($like);
//     $entityManager->flush();

//     $likeCount = count($likes) + 1;
//     $isLiked = true;
// }
//     return new JsonResponse(['like_count' => $likeCount, 'is_liked' => $isLiked]);
// }






}
