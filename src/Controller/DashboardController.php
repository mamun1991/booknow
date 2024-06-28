<?php

namespace App\Controller;

use App\Repository\BookindorderRepository;
use App\Repository\NotificationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'page_title' => 'Dashboard Controller',
        ]);
    }

    #[Route('/dashboard/home', name: 'home_dashboard')]
    public function dashHome(): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'page_title' => 'Dashboard Controller',
        ]);
    }

    #[Route('/dashboard/getMonthlyOrderReport')]
    public function getMonthlyOrderReport(Request $request, BookindorderRepository $bo, SerializerInterface $serializer): Response
    {
        try {
            if ($request->headers->get('X-H') !== '1234') {
                return $this->json(['error' => 'Unauthorized'], 401);
            }

            if (json_last_error() !== JSON_ERROR_NONE) {
                return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
            }

            $totaldata = $bo->getMonthlyOrderReport();
            if (!$totaldata) {
                return new JsonResponse(['status' => 'Error', 'message' => 'No Destination found!'], Response::HTTP_OK);
            }
            $reportData = $serializer->serialize($totaldata, "json", ['groups' => 'book']);
            $reportData = json_decode($reportData);
            // print_r($reportData);exit;
            $redata = [];
            $month = [];
            foreach ($reportData as $report) {
                $redata[] = $report->totalRent;
                $month[] = $report->month;
            }
            // print_r($redata);
            // print_r($month);
            // exit;
            return new JsonResponse(['status' => 'Success', 'message' => 'Login Successfull', 'getReportByRent' => $redata, 'getReportByMonth' => $month], Response::HTTP_OK);
        } catch (\Exception $e) {
            // Return an error response if something goes wrong
            print_r($e->getMessage());
            return new JsonResponse(['status' => 'Error', 'message' => 'Failed to load data'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/dashboard/getMonthlyCountRent')]
    public function getMonthlyCountRent(Request $request, BookindorderRepository $bo, SerializerInterface $serializer): Response
    {
        try {
            if ($request->headers->get('X-H') !== '1234') {
                return $this->json(['error' => 'Unauthorized'], 401);
            }

            if (json_last_error() !== JSON_ERROR_NONE) {
                return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
            }

            $totaldata = $bo->getMonthlyCountRent();
            if (!$totaldata) {
                return new JsonResponse(['status' => 'Error', 'message' => 'No Destination found!'], Response::HTTP_OK);
            }
            $reportData = $serializer->serialize($totaldata, "json", ['groups' => 'book']);
            $reportData = json_decode($reportData);
            // print_r($reportData);exit;
            $redata = [];
            $month = [];
            foreach ($reportData as $report) {
                $redata[] = $report->totalRent;
                $month[] = $report->month;
            }
            // print_r($redata);
            // print_r($month);
            // exit;
            return new JsonResponse(['status' => 'Success', 'message' => 'Login Successfull', 'getReportByRent' => $redata, 'getReportByMonth' => $month], Response::HTTP_OK);
        } catch (\Exception $e) {
            // Return an error response if something goes wrong
            print_r($e->getMessage());
            return new JsonResponse(['status' => 'Error', 'message' => 'Failed to load data'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/dashboard/getRealNotification')]
    public function getRealNotification(Request $request, NotificationRepository $no, EntityManagerInterface $entityManager): Response
    {
        try {
            // $neworder = $session->get('newOrder');
            $getorder = '';
            $corder = 0;
            $notification = $no->findAll();
            if ($notification !== null) {
                // $getorder = $notification->getNotification();
                foreach ($notification as $notifications) {
                    $getorder = $notifications->getNotification();
                    $corder ++;
                }
            }

            return new JsonResponse(['getNewOrder' => $getorder, 'status' => 'Success', 'corder' => $corder], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['status' => 'Error', 'message' => 'Failed to connect to WebSocket server'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/dashboard/removeNotification')]
    public function removeNotification(Request $request, NotificationRepository $no, EntityManagerInterface $entityManager): Response
    {
        try {
            // $neworder = $session->get('newOrder');
            $getorder = 'remove';
            $notification = $no->findAll();
            if ($notification !== null) {
                // $getorder = $notification->getNotification();
                // print_r($value); exit;
                foreach ($notification as $notifications) {
                    $entityManager->remove($notifications);
                }

                // $entityManager->remove($notification);
                $entityManager->flush();
            }

            return new JsonResponse(['getNewOrder' => $getorder, 'status' => 'Success'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['status' => 'Error', 'message' => 'Failed to connect to WebSocket server'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/dashboard/getClientTotalRent')]
    public function getClientTotalRent(Request $request, BookindorderRepository $bo, SerializerInterface $serializer): Response
    {
        try {
            if ($request->headers->get('X-H') !== '1234') {
                return $this->json(['error' => 'Unauthorized'], 401);
            }

            if (json_last_error() !== JSON_ERROR_NONE) {
                return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
            }

            $totaldata = $bo->getClientTotalRent();
            if (!$totaldata) {
                return new JsonResponse(['status' => 'Error', 'message' => 'No Destination found!'], Response::HTTP_OK);
            }
            $reportData = $serializer->serialize($totaldata, "json", ['groups' => 'book']);
            $reportData = json_decode($reportData);
            // print_r($reportData);exit;

            $piecolor = array();

            for ($i = 0; $i < count($reportData); $i++) {
                $piecolor[] = '#' . $this->random_color();
            }

            $redata = [];
            $client = [];
            foreach ($reportData as $report) {
                $redata[] = $report->totalRent;
                $client[] = $report->hotel;
            }
            // print_r($redata);
            // print_r($piecolor);exit;
            // exit;
            return new JsonResponse(['status' => 'Success', 'color' => $piecolor, 'getReportByRent' => $redata, 'getReportByMonth' => $client], Response::HTTP_OK);
        } catch (\Exception $e) {
            // Return an error response if something goes wrong
            print_r($e->getMessage());
            return new JsonResponse(['status' => 'Error', 'message' => 'Failed to load data'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/dashboard/getClientTotalCount')]
    public function getClientTotalCount(Request $request, BookindorderRepository $bo, SerializerInterface $serializer): Response
    {
        try {
            if ($request->headers->get('X-H') !== '1234') {
                return $this->json(['error' => 'Unauthorized'], 401);
            }

            if (json_last_error() !== JSON_ERROR_NONE) {
                return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
            }

            $totaldata = $bo->getClientTotalCount();
            if (!$totaldata) {
                return new JsonResponse(['status' => 'Error', 'message' => 'No Destination found!'], Response::HTTP_OK);
            }
            $reportData = $serializer->serialize($totaldata, "json", ['groups' => 'book']);
            $reportData = json_decode($reportData);
            // print_r($reportData);exit;

            $piecolor = array();

            for ($i = 0; $i < count($reportData); $i++) {
                $piecolor[] = '#' . $this->random_color();
            }

            $redata = [];
            $client = [];
            foreach ($reportData as $report) {
                $redata[] = $report->totalRent;
                $client[] = $report->hotel;
            }
            // print_r($redata);
            // print_r($piecolor);exit;
            // exit;
            return new JsonResponse(['status' => 'Success', 'color' => $piecolor, 'getReportByRent' => $redata, 'getReportByMonth' => $client], Response::HTTP_OK);
        } catch (\Exception $e) {
            // Return an error response if something goes wrong
            print_r($e->getMessage());
            return new JsonResponse(['status' => 'Error', 'message' => 'Failed to load data'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function random_color_part()
    {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }

    public function random_color()
    {
        return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }
}
