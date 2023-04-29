<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthenticationController extends AbstractController
{
    #[Route('/authentication', name: 'app_authentication')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {   
        $session = $request->getSession();
        $id=$session->get('id');
        if(isset($id)){
           return($this->redirectToRoute('app-home'));
        }
        if (($email = $request->query->get('email')) && ($password = $request->query->get('password'))) {
            $userIsFound = $entityManager->getRepository(User::class)->findOneByEmail($email);
            if (isset($userIsFound)) {
                if ($userIsFound->getPassword() == $password) {
                    $session->set('id',$userIsFound->getId());
                    return $this->redirectToRoute('app_home');
                }
                else{
                    $this->addFlash('erreur', 'your email or password is incorrect ! ');   
                }
            }
            else{
                $this->addFlash('erreur', 'you are not subscribed ! ');
            }
        }
        return $this->render('authentication/index.html.twig', [
            'title' => 'sign up'
        ]);
    }
}
