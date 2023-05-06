<?php

namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController extends AbstractController
{

    private $em;
	public function __construct(EntityManagerInterface $em){
       
        $this->em = $em;
    }

    
    #[Route('/api/{id}', name: 'app_api')]
    public function getEventData($id,SerializerInterface $serializer): JsonResponse
    {
        $repository = $this->em->getRepository('App\Entity\Event');
        $event = $repository->find($id);

        $data = $this->json(
            $event,
            200,
            [],
            ['groups' => ['event:read']]
        );

        return $data;

    }
}
