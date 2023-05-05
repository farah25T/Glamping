<?php

namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{

    private $em;
	public function __construct(EntityManagerInterface $em){
       
        $this->em = $em;
    }

    
    #[Route('/api/{id}', name: 'app_api')]
    public function getEventData($id): JsonResponse
    {
        $repository = $this->em->getRepository('App\Entity\Event');
        $event = $repository->find($id);

        return $this->json($event);
    }
}
