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
	public function __construct(EntityManagerInterface $em
    ){

        $this->em = $em;
    }

    #[Route('/event/{id}', methods:['GET'], name: 'app_event_page')]
    public function show($id,Request $request)
    {
        
        $session = $request->getSession();
        $user = null;
        $userid = $session->get('id');

        if (isset($userid)) {
            $user = $this->em->getRepository(User::class)->find($userid);
        }

        $repository = $this->em->getRepository('App\Entity\Event');
        $event = $repository->find($id);
        $toggled = false;

        if ($event ){
            $users = $event->getUsers();
            if ($user){
                foreach ($users as $u) {
                    if ($u->getId() === $user->getId())
                    { 
                        $toggled = true;
                        break;
                    }
                }
            }
            $likes = count($users);
            return $this->render('event_page/index.html.twig', [
                'event' => $event,
                'user' => $user,
                'likes' => $likes,
                'toggled' => $toggled
            ]);
        }
        
        if (!$event) {
            return $this->redirectToRoute('app_home', [
                'user' => $user
            ]);
        }
  
    }



    #[Route('/event/{id}/like', methods:['POST'], name: 'like_action')]
    public function likeAction($id,Request $request)
    {
        $session = $request->getSession();
        $user = null;
        $userid = $session->get('id');
        if (isset($userid)) {
            $user = $this->em->getRepository(User::class)->find($userid);
        }
        else{
            return $this->redirectToRoute('app_authentication');
        }

        $repository = $this->em->getRepository('App\Entity\Event');
        $event = $repository->find($id);

        if (!$event) {
            return $this->redirectToRoute('app_home', [
                'user' => $user
            ]);
        }

        $likes = $event->getUsers();
        $isLiked = false;
        foreach ($likes as $like) {
         if ($like->getId() === $user->getId()) {
          $isLiked = true;
          break;
         }
         }

    if (!$isLiked) {
      // Like the event
    $event->addUser($user);
    $this->em->flush();
    }
    return new JsonResponse(["message"=>"ok"]);

    }


    #[Route('/event/{id}/dislike', methods:['POST'], name: 'dislike_action')]
    public function dislikeAction($id,Request $request)
    {
        $session = $request->getSession();
        $user = null;
        $userid = $session->get('id');
        if (isset($userid)) {
            $user = $this->em->getRepository(User::class)->find($userid);
        }
        else{
            return $this->redirectToRoute('app_authentication');
        }
        $repository = $this->em->getRepository('App\Entity\Event');
        $event = $repository->find($id);
        if (!$event) {
            return $this->redirectToRoute('app_home', [
                'user' => $user
            ]);
        }

        $likes = $event->getUsers();
        $isLiked = false;
        foreach ($likes as $like) {
         if ($like->getId() === $user->getId()) {
          $isLiked = true;
          break;
    }
}

    if ($isLiked) {
      // Like the event
    $event->removeUser($user);
    $this->em->flush();
}
    return new JsonResponse(["message"=>"ok"]);
    }




}
