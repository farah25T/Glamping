<?php

namespace App\Controller;
use App\Entity\Event;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
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
    public function index(Request $request,EntityManagerInterface $entityManager ): Response
    {
        $session = $request->getsession();
        $user = null;
        $userid = $session->get('id');
        if (isset($userid)) {
            $user = $this->em->getRepository(User::class)->find($userid);
        }
        $maxGuests = $entityManager->getRepository(Event::class)->findMaxNbrGuests();

        return $this->render('catalogue_page/index.html.twig', [
            'controller_name' => 'CataloguePageController',
            'user' => $user,
            'guests'=>$maxGuests,
        ]);
    }
}