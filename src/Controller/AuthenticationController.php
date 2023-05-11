<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


class AuthenticationController extends AbstractController
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/authentication', name: 'app_authentication')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = $request->getSession();
        $id = $session->get('id');
        if (isset($id)) {
            return ($this->redirectToRoute('app_home'));
        }
        $email = $request->request->get('email');
        $password = $request->request->get('password');
        if (isset($email) && isset($password) ) {
            $userIsFound = $entityManager->getRepository(User::class)->findOneByEmail($email);
            if (isset($userIsFound)) {
                if ($this->passwordHasher->isPasswordValid($userIsFound,$password)) {
                    $session->set('id', $userIsFound->getId());
                    if( $url=$request->query->get('url'))
                    return $this->redirect($url); 
                    else {
                     return $this->redirectToRoute('app_home');}
                } else {
                    $this->addFlash('erreur', 'your email or password is incorrect ! ');
                }
            } else {
                $this->addFlash('erreur', 'you are not subscribed ! ');
            }
        }
        return $this->render('authentication/index.html.twig', [
            'title' => 'sign in','user'=>null
        ]);
    }

    #[Route('/authentication/signup', name: 'app_authentication_signup')]
    public function signup(Request $request, EntityManagerInterface $entityManager): Response
    {
        
        $session = $request->getSession();
        $id = $session->get('id');
        if (isset($id)) {
            return ($this->redirectToRoute('app_home'));
        }
       
       
        $email = $request->request->get('email');
        $password = $request->request->get('password');
        $name = $request->request->get('name');

        if (isset($email) && isset($password) && isset($name)) {
            $userIsFound = $entityManager->getRepository(User::class)->findOneByEmail($email);
            if (!isset($userIsFound)) {
                $user = new User();
                $hashedPassword = $this->passwordHasher->hashPassword($user, $password);
                $user->setName($name);
                $user->setEmail($email);
                $user->setPassword($hashedPassword);
                $entityManager->getRepository(User::class)->save($user);
                $entityManager->flush();
                $session->set('id', $user->getId());
                return $this->redirectToRoute('app_home');
            } else {
                $this->addFlash('erreur', 'this email is already used ! ');
            }
        }

        return $this->render('authentication/signup.html.twig', [
            'title' => 'sign up','user'=>null
        ]);
    }
    #[Route('/authentication/logout', name: 'app_authentication_logout')]
    public function logout(Request $request, EntityManagerInterface $entityManager): Response
    {            $session = $request->getSession();
        $id=$session->get('id');
        if (!isset($id)) {
            return ($this->redirectToRoute('app_authentication'));
        }
        else {
            $session->clear();
            return ($this->redirectToRoute('app_home'));
        }
    }

}
