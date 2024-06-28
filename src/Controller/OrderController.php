<?php

namespace App\Controller;

use App\Repository\BookindorderRepository;
use App\Repository\NotificationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;



class OrderController extends AbstractController
{
    #[Route('/dashboard/order', name: 'app_order')]
    public function index(): Response
    {
        return $this->render('order/index.html.twig', [
            'page_title' => 'Order Controller',
        ]);
    }


    #[Route('/dashboard/getAllOrders')]
    public function getAllOrders(Request $request, BookindorderRepository $bo, SerializerInterface $serializer): Response
    {
        if ($request->headers->get('X-H') !== '1234') {
            return $this->json(['error' => 'Unauthorized'], 401);
        }

        if (json_last_error() !== JSON_ERROR_NONE) {
            return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
        }

        $order = $bo->findAllDesc();
        if (!$order) {
            return new JsonResponse(['status' => 'Error', 'message' => 'No Destination found!'], Response::HTTP_OK);
        }
        $bookingData = $serializer->serialize($order, "json", ['groups' => 'book']);
        // print_r($bookingData);exit;
        return new JsonResponse(['status' => 'Success', 'message' => 'Get booking data', 'bookingData' => $bookingData], Response::HTTP_OK);
    }

    #[Route('/dashboard/updateOrderStatus', methods: 'post')]
    public function updateOrderStatus(Request $request, EntityManagerInterface $entityManager, BookindorderRepository $bo): Response
    {
        try {
            if (json_last_error() !== JSON_ERROR_NONE) {
                return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
            }

            $json = $request->getContent();
            $data = json_decode($json);

            $order = $bo->find($data->orderid);

            // print_r($admin);exit;
            $order->setStatus($data->action);

            $entityManager->persist($order);
            $entityManager->flush();

            // print_r($data);exit;
            return new JsonResponse(['status' => 'Success', 'message' => 'Order updated successfully'], Response::HTTP_OK);
        } catch (\Exception $e) {
            // Return an error response if something goes wrong
            print_r($e->getMessage());
            return new JsonResponse(['status' => 'Error', 'message' => 'Failed to insert data'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/dashboard/getRealNotificationUpdate')]
    public function getRealNotificationUpdate(Request $request, NotificationRepository $no, BookindorderRepository $bo, SessionInterface $session): Response
    {
        try {
            $order = null;
            $totalOrder = $bo->totalPendingOrder();
            // print_r($totalOrder = $notification[0]['totalorder']);exit;

            $getorder = '';
            $totalor = 0;
            $notification = $no->findAll();
            if ($notification !== null) {
                // $getorder = $notification->getNotification();
                foreach ($notification as $notifications) {
                    $getorder = $notifications->getNotification();
                    $totalor++;
                }
            }

            if ($totalOrder !== null) {
                $order = $totalOrder[0]['totalorder'];
            }

            return new JsonResponse(['getNewOrder' => $getorder, 'order' => $order, 'reloadTotal' => $totalor, 'status' => 'Success'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['status' => 'Error', 'message' => 'Failed to connect to WebSocket server'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
