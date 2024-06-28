<?php

namespace App\Controller;

use App\Entity\Destination;
use App\Entity\Setdest;
use App\Repository\DestinationRepository;
use App\Repository\UserRepository;
use App\Repository\SetdestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DestinationController extends AbstractController
{
    #[Route('/dashboard/destination', name: 'app_destination')]
    public function index(): Response
    {
        return $this->render('destination/index.html.twig', [
            'page_title' => 'Destination Controller',
        ]);
    }

    #[Route('/dashboard/addDestination', name: 'add_destination')]
    public function addDestination(Request $request, EntityManagerInterface $em, ValidatorInterface $validator): Response
    {
        try {
            if (json_last_error() !== JSON_ERROR_NONE) {
                return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
            }

            $json = $request->getContent();
            $data = json_decode($json);

            $destination = new Destination();
            $destination->setDestname($data->destname);
            $destination->setDeststatus($data->deststatus);

            $errors = $validator->validate($destination);
            if (count($errors) > 0) {
                return new JsonResponse(['status' => 'Error', 'message' => 'Validation error'], Response::HTTP_BAD_REQUEST);
            }

            $em->persist($destination);
            $em->flush();

            // print_r($data);exit;
            return new JsonResponse(['status' => 'Success', 'message' => 'Destination inserted'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['status' => 'Error', 'message' => 'Failed to insert data'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/dashboard/getDestination', methods: 'get')]
    public function getDestination(SerializerInterface $serializer, Request $request, DestinationRepository $dr): Response
    {
        if ($request->headers->get('X-H') !== '1234') {
            return $this->json(['error' => 'Unauthorized'], 401);
        }
        // print_r('somedata');exit;
        $destination = $dr->findAll();

        $drdata = $serializer->serialize($destination, "json", ['groups' => 'destination']);
        // dump($drdata);exit;
        return new JsonResponse(['getDestination' => $drdata], Response::HTTP_OK);
    }

    #[Route('/dashboard/getClientName', methods: 'get')]
    public function getClientName(SerializerInterface $serializer, Request $request, UserRepository $ur): Response
    {
        if ($request->headers->get('X-H') !== '1234') {
            return $this->json(['error' => 'Unauthorized'], 401);
        }
        // print_r('somedata');exit;
        $getClient = $ur->getClientFromDest();

        $drdata = $serializer->serialize($getClient, "json", ['groups' => 'user']);
        // dump($drdata);exit;
        return new JsonResponse(['clientName' => $drdata], Response::HTTP_OK);
    }

    #[Route('/dashboard/updateDestination', methods: 'post')]
    public function updateDestination(Request $request, DestinationRepository $dr, ValidatorInterface $validator, EntityManagerInterface $em): Response
    {
        try {
            if (json_last_error() !== JSON_ERROR_NONE) {
                return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
            }

            $json = $request->getContent();
            $data = json_decode($json);

            // dd($data);

            $destination = $dr->find($data->id);
            $destination->setDestname($data->destname);
            $destination->setDeststatus($data->deststatus);

            $errors = $validator->validate($destination);
            if (count($errors) > 0) {
                return new JsonResponse(['status' => 'Error', 'message' => 'Validation error'], Response::HTTP_BAD_REQUEST);
            }

            $em->persist($destination);
            $em->flush();

            // print_r($data);exit;
            return new JsonResponse(['status' => 'Success', 'message' => 'Destination updated'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['status' => 'Error', 'message' => 'Failed to insert data'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/dashboard/deleteDestination', methods: 'delete')]
    public function deleteDestination(Request $request, DestinationRepository $dr, EntityManagerInterface $em): Response
    {
        if ($request->headers->get('X-H') !== '1234') {
            return $this->json(['error' => 'Unauthorized'], 401);
        }

        $json = $request->getContent();
        $data = json_decode($json);

        $destination = $dr->find($data->deleteDataId);
        $em->remove($destination);
        $em->flush();
        // print_r($User);exit;
        return new JsonResponse(['status' => 'Success', 'message' => 'Destination deleted!'], Response::HTTP_OK);
    }

    #[Route('/dashboard/setDestination', name: 'setDestination')]
    public function setDestination(Request $request, EntityManagerInterface $em, ValidatorInterface $validator, DestinationRepository $dr): Response
    {
        try {
            if (json_last_error() !== JSON_ERROR_NONE) {
                return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
            }

            $json = $request->getContent();
            $data = json_decode($json);

            $desid = $dr->findOneBy(['id' => $data->destiname]);

            // dd($data);

            $destination = new Setdest();
            $destination->setPrice($data->price);
            $destination->setStatus($data->status);
            $destination->setClientname($data->clientname);
            $destination->setHotelid($data->clientId);
            $destination->setDestid($desid);

            $errors = $validator->validate($destination);
            if (count($errors) > 0) {
                return new JsonResponse(['status' => 'Error', 'message' => 'Validation error'], Response::HTTP_BAD_REQUEST);
            }

            $em->persist($destination);
            $em->flush();
            // dd($data);

            // print_r($data);exit;
            return new JsonResponse(['status' => 'Success', 'message' => 'Destination set'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['status' => 'Error', 'message' => 'Failed to insert data'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/dashboard/getSetDest', methods: 'get')]
    public function getSetDest(SerializerInterface $serializer, Request $request, SetdestRepository $sd): Response
    {
        if ($request->headers->get('X-H') !== '1234') {
            return $this->json(['error' => 'Unauthorized'], 401);
        }
        // print_r('somedata');exit;
        $getset = $sd->getSetdestdata();
        $drdata = $serializer->serialize($getset, "json", ['groups' => 'getset']);
        
        return new JsonResponse(['getSet' => $drdata], Response::HTTP_OK);
    }

    #[Route('/dashboard/getSetUpdate', methods: 'post')]
    public function getSetUpdate(Request $request, SetdestRepository $sd, ValidatorInterface $validator, EntityManagerInterface $em, DestinationRepository $dr): Response
    {
        try {
            if (json_last_error() !== JSON_ERROR_NONE) {
                return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
            }

            $json = $request->getContent();
            $data = json_decode($json);
            $desid = $dr->findOneBy(['id' => $data->destiname]);

            // dd($data);

            $destination = $sd->find($data->id);
            $destination->setPrice($data->price);
            $destination->setStatus($data->status);
            $destination->setClientname($data->clientname);
            $destination->setDestid($desid);

            $errors = $validator->validate($destination);
            if (count($errors) > 0) {
                return new JsonResponse(['status' => 'Error', 'message' => 'Validation error'], Response::HTTP_BAD_REQUEST);
            }

            $em->persist($destination);
            $em->flush();

            // print_r($data);exit;
            return new JsonResponse(['status' => 'Success', 'message' => 'Destination updated'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['status' => 'Error', 'message' => 'Failed to insert data'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/dashboard/deleteSetDest', methods: 'delete')]
    public function deleteSetDest(Request $request, SetdestRepository $dr, EntityManagerInterface $em): Response
    {
        if ($request->headers->get('X-H') !== '1234') {
            return $this->json(['error' => 'Unauthorized'], 401);
        }

        $json = $request->getContent();
        $data = json_decode($json);

        $destination = $dr->find($data->deleteDataId);
        $em->remove($destination);
        $em->flush();
        // print_r($User);exit;
        return new JsonResponse(['status' => 'Success', 'message' => 'Destination deleted!'], Response::HTTP_OK);
    }
}
