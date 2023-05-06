<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use function Webmozart\Assert\Tests\StaticAnalysis\string;
use Symfony\Component\Security\Core\Security;
class EventUserController extends AbstractController
{

    #[Route('/eventpage/user', name: 'app_event_user')]
    public function index(EntityManagerInterface $entityManager , SessionInterface $session): Response
    {

        $userIsFound = $entityManager->getRepository(User::class)->findOneById($session->get('id'));
        return $this->render('event_user/index.html.twig', [
            'user'=>$userIsFound,
        ]);
    }
}
