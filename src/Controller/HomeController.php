<?php

namespace App\Controller;

use App\Entity\Bookindorder;
use App\Entity\Notification;
use App\Repository\BookindorderRepository;
use App\Repository\SetdestRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\WebSocket\NotificationHandler;
use Nelmio\CorsBundle\Annotation\Cors;


class HomeController extends AbstractController
{

    // private $notificationHandler;

    // public function __construct()
    // {
    //     $this->notificationHandler = $notificationHandler;
    // }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $response = $this->render('home/index.html.twig', [
            'page_title' => 'Main Page',
        ]);
        // $response->headers->set('Access-Control-Allow-Origin', 'https://book.taxikone.com');
        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:8000');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
        $response->headers->set('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Authorization');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');

        return $response;

        // return $this->render('home/index.html.twig', [
        //     'page_title' => 'Main Page',
        // ]);
    }


    #[Route('/getallDestination')]
    public function getallDestination(Request $request, SetdestRepository $sd, SerializerInterface $serializer): Response
    {
        $json = $request->getContent();
        $data = json_decode($json);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
        }

        $dest = $sd->getSetdestByName($data->dataid);
        if (!$dest) {
            return new JsonResponse(['status' => 'Error', 'message' => 'No Destination found!'], Response::HTTP_OK);
        }
        $hotelData = $serializer->serialize($dest, "json", ['groups' => 'getset']);
        // print_r($hotelData);exit;
        return new JsonResponse(['status' => 'Success', 'message' => 'Login Successfull', 'getDestinationById' => $hotelData], Response::HTTP_OK);
    }

    #[Route('/submitBooking')]
    public function submitBooking(Request $request, EntityManagerInterface $en, ValidatorInterface $validator): Response
    {
        try {
            if (json_last_error() !== JSON_ERROR_NONE) {
                return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
            }
            $json = $request->getContent();
            $data = json_decode($json);

            $dateTime = \DateTime::createFromFormat('d-m-Y', $data->bookingdate);
            $monthName = $dateTime->format('F');
            $year = $dateTime->format('Y');

            $booking = new Bookindorder();

            $booking->setHotel($data->hotel);
            $booking->setDestination($data->destination);
            $booking->setBookingdate($data->bookingdate);
            $booking->setOrderdate($data->orderdate);
            $booking->setDescription($data->description);
            $booking->setCabs($data->cabs);
            $booking->setRent($data->rent);
            $booking->setCabdatacount($data->cabdatacount);
            $booking->setTime($data->time);
            $booking->setStatus(1);
            $booking->setMonth($monthName);
            $booking->setYear($year);

            $errors = $validator->validate($booking);
            if (count($errors) > 0) {
                return new JsonResponse(['status' => 'Error', 'message' => 'Validation error'], Response::HTTP_BAD_REQUEST);
            }

            $en->persist($booking);
            $en->flush();

            $notification = new Notification();
            $notification->setNotification($data->hotel);
            $en->persist($notification);
            $en->flush();

            // $session->set('newOrder', 'newOrder');
            // $session->set('newOrderUp', 'newOrderUp');

            // print_r($data);exit;
            return new JsonResponse(['status' => 'Success', 'message' => 'Your Booking Confirmed'], Response::HTTP_OK);
        } catch (\Exception $e) {
            dump($e);
            exit;
            return new JsonResponse(['status' => 'Error', 'message' => 'Failed to order'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/checkBookingOrder', methods: 'POST')]
    public function checkBookingOrder(Request $request, BookindorderRepository $bo, SerializerInterface $serializer): Response
    {
        $json = $request->getContent();
        $data = json_decode($json);

        // dd($data);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
        }

        $hotel = $bo->getByHotelName($data->hotel);
        // dd($dest);
        if (!$hotel) {
            return new JsonResponse(['status' => 'Error', 'message' => 'No data found!'], Response::HTTP_OK);
        }
        $hotelData = $serializer->serialize($hotel, "json", ['groups' => 'book']);
        // print_r($hotelData);exit;
        return new JsonResponse(['status' => 'Success', 'message' => 'Bookin data', 'booking' => $hotelData], Response::HTTP_OK);
    }

    #[Route('/mainLogin', name: 'mainLogin')]
    public function mainLogin(Request $request, UserRepository $ur, SerializerInterface $serializer): Response
    {
        $json = $request->getContent();
        $data = json_decode($json);

        // print_r($data->name); exit;
        if (json_last_error() !== JSON_ERROR_NONE) {
            return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
        }

        $getUser = $ur->getSingleUserLogin($data);
        if (!$getUser) {
            return new JsonResponse(['status' => 'Error', 'message' => 'No match found!'], Response::HTTP_OK);
        }
        $UserData = $serializer->serialize($getUser, "json", ['groups' => 'user']);
        // print_r($UserData); exit;

        return new JsonResponse(['status' => 'Success', 'message' => 'Login Successfull', 'getUser' => $UserData], Response::HTTP_OK);
    }

    #[Route('/cancelOrder', name: 'cancelOrder')]
    public function cancelOrder(Request $request, BookindorderRepository $br, EntityManagerInterface $en, ValidatorInterface $validator)
    {
        try {
            if (json_last_error() !== JSON_ERROR_NONE) {
                return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
            }

            $json = $request->getContent();
            $data = json_decode($json);

            $order = $br->find($data->hotelId);

            // print_r($order);exit;
            $order->setStatus(2);

            $errors = $validator->validate($order);
            if (count($errors) > 0) {
                return new JsonResponse(['status' => 'Error', 'message' => 'Validation error'], Response::HTTP_BAD_REQUEST);
            }

            $en->persist($order);
            $en->flush();

            // print_r($data);exit;
            return new JsonResponse(['status' => 'Success', 'message' => 'Order is canceled!'], Response::HTTP_OK);
        } catch (\Exception $e) {
            // Return an error response if something goes wrong
            print_r($e->getMessage());
            return new JsonResponse(['status' => 'Error', 'message' => 'Failed to insert data'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
