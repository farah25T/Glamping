<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Event;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class BookingController extends AbstractController
{
    #[Route('/Booking', name: 'booking_app')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = $request->getSession();
        $user = null;
        $eventId = $request->request->get('event');
        $id = $session->get('id');
        if (!isset($id)) {
            return $this->redirectToRoute('app_home');
        }
        if (isset($id)) {
            $user = $entityManager->getRepository(User::class)->find($id);
        }
        if (!isset($eventId)) {
            return $this->redirectToRoute('app_home');
        } else {
            $guests = $request->request->get('GuestNbr');
            $event = $entityManager->getRepository(Event::class)->find($eventId);
            $booking = new Booking();
            $booking->setIdEvent($event);
            $booking->setIdUser($user);
            $booking->setNbrGuests($guests);
            $booking->setDate(new \DateTime());
            $event->setNbrGuestsMax($event->getNbrGuestsMax() - $guests);
            $entityManager->persist($booking);
            $entityManager->persist($event);
            $entityManager->flush();


            $session->set('last_booking_id', $booking->getId());

            return $this->redirectToRoute('booking_confirmed');
        }
    }

    #[Route('/Booking/confirmed', name: 'booking_confirmed')]
    public function confirmation(Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = $request->getSession();
        $bookingId = $session->get('last_booking_id');

        if (!$bookingId) {
            return $this->redirectToRoute('app_home');
        }

        $booking = $entityManager->getRepository(Booking::class)->find($bookingId);
        $eventId = $booking->getIdEvent()->getId();
        $event = $entityManager->getRepository(Event::class)->find($eventId);
        $userId = $booking->getIdUser()->getId();
        $user = $entityManager->getRepository(User::class)->find($userId);
        $guestnbr = $booking->getNbrGuests();

        if (!$booking) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('booking/index.html.twig', [
            'booking' => $booking,
            'event' => $event,
            'user' => $user,
            'guestnbr' => $guestnbr,
        ]);
    }
    #[Route('/Booking/cancel', name: 'booking_cancel')]
    public function cancel(Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = $request->getSession();
        $bookingId = $session->get('last_booking_id');

        if (!$bookingId) {
            return $this->redirectToRoute('app_home');
        }
        $booking = $entityManager->getRepository(Booking::class)->find($bookingId);

        if (!$booking) {
            return $this->redirectToRoute('app_home');
        }
        $event = $booking->getIdEvent();
        $guests = $booking->getNbrGuests();
        $event->setNbrGuestsMax($event->getNbrGuestsMax() + $guests);
        $entityManager->remove($booking);
        $entityManager->flush();
        $session->remove('last_booking_id');
        return $this->redirectToRoute('app_home');
    }
}
