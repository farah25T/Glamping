<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Validation;

class UserController extends AbstractController
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
   #[Route('/image', name: 'app_image', methods: ['POST'])]
public function handleImageUpload(Request $request, SluggerInterface $slugger, EntityManagerInterface $entityManager): Response
{
    $session = $request->getSession();
    $user = null;
    $id = $session->get('id');
    
    if (isset($id)) {
        $user = $entityManager->getRepository(User::class)->find($id);
    }

    $uploadedImage = $request->files->get('user_image');

        // Validate the file
        $validator = Validation::createValidator();
        $constraints = [
            new File([
                'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'],
                'mimeTypesMessage' => 'Please upload a valid image file (JPEG, PNG, GIF).',
            ]),
        ];

        $errors = $validator->validate($uploadedImage, $constraints);
    if ($uploadedImage && count($errors) == 0) {
        $originalFilename = pathinfo($uploadedImage->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename . '-' . uniqid() . '.' . $uploadedImage->guessExtension();

        try {
            $uploadedImage->move(
                $this->getParameter('image_directory'),
                $newFilename
            );
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        // Update the User entity with the new image filename
        $user->setImageFilename($newFilename);

        // Save the updated User entity
        $entityManager->persist($user);
        $entityManager->flush();
    }

    return $this->redirectToRoute('app_profile');
}


    #[Route('/image/delete', name: 'app_delete_picture', methods: ['POST'])]
    public function DeleteImage(Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = $request->getSession();
        $user = null;
        $id = $session->get('id');

        if (isset($id)) {
            $user = $entityManager->getRepository(User::class)->find($id);
        }

        // Get the user's image filename
        $imageFilename = $user->getImageFilename();

        // If the user has an image
        if ($imageFilename) {
            // Remove the file from the filesystem
            $filesystem = new Filesystem();
            $filesystem->remove($this->getParameter('image_directory') . '/' . $imageFilename);

            // Set the user's image filename to null and save the changes
            $user->setImageFilename(null);
            $entityManager->persist($user);
            $entityManager->flush();
        }
        return $this->redirectToRoute('app_profile');

}
    #[Route('/user/update', name: 'app_user_update', methods: ['POST'])]
    public function UserUpdate(Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = $request->getSession();
        $user = null;
        $id = $session->get('id');

        if (!isset($id)) {
            return $this->redirectToRoute('app_authentication');
        }
        $user = $entityManager->getRepository(User::class)->find($id);
        $userName=$request->request->get('username');
        if(isset($userName)){
            $address = $request->request->get('address');
            $phone = $request->request->get('phone');
            $fullName= $request->request->get('fullname');
            $password= $request->request->get("password");
            $gender=$request->request->get("gender");
            $user->setName($userName);
            $user->setFullName($fullName);
            $user->setPhone($phone);
            $user->setAddress($address);
            $user->setGender($gender);
            if(isset($password)){
                $hashedPassword = $this->passwordHasher->hashPassword($user, $password);
                $user->setPassword($hashedPassword);
            }
            $entityManager->getRepository(User::class)->save($user,true);
            return $this->redirectToRoute('app_profile');
        }
        $this->addFlash('erreur', 'UserName field is missing !');
       return $this->redirectToRoute('app_authentication');
    }
    #[Route('/user/delete', name: 'app_user_delete')]
    public function UserDelete(Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = $request->getSession();
        $user = null;
        $id = $session->get('id');

        if (!isset($id)) {
            return $this->redirectToRoute('app_authentication');
        }
        $user = $entityManager->getRepository(User::class)->find($id);
        $entityManager->getRepository(User::class)->remove($user, true);
        return $this->redirectToRoute('app_authentication_logout');

    }

}