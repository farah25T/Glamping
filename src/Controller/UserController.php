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
use Symfony\Component\String\Slugger\SluggerInterface;

class UserController extends AbstractController
{
    // ...

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

    if ($uploadedImage) {
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

}}