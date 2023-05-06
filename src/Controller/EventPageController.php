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
    public function show($id,Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = $request->getSession();
        $user = null;
        $idUser = $session->get('id');
        if (isset($idUser)) {
            $user = $entityManager->getRepository(User::class)->find($idUser);
        }

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

   
// #[Route('/like', methods:['POST'], name: 'like_action')]
// public function likeAction(Request $request, RouterInterface $router): JsonResponse
// {

//     $repository = $this->em->getRepository('App\Entity\Event');
//     $event_id = $request->request->get('event_id');
//     $event = $repository->find($event_id);


//     if (!$event) {
//         throw $this->createNotFoundException('Event not found');
//     }

//     $user = $this->getUser();
//     if (!$user) {
//         // Redirect the user to the login page
//         $loginUrl = $router->generate('app_login');
//         return new JsonResponse(['error' => 'User not logged in', 'login_url' => $loginUrl], 401);
//     }

//     $likes = $event->getLikes();
//     foreach ($likes as $like) {
//         if ($like->getUser() === $user) {
//             $entityManager->remove($like);
//             $entityManager->flush();

//             $likeCount = count($likes) - 1;
//             $isLiked = false;
//             return new JsonResponse(['like_count' => $likeCount, 'is_liked' => $isLiked]);
//         }
//     }

//     $like = new Like();
//     $like->setEvent($event);
//     $like->setUser($user);
//     $entityManager->persist($like);
//     $entityManager->flush();

//     $likeCount = count($likes) + 1;
//     $isLiked = true;
//     return new JsonResponse(['like_count' => $likeCount, 'is_liked' => $isLiked]);
// }






}
