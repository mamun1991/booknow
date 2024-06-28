<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\User;
use App\Repository\AdminRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{
    #[Route('/dashboard/user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'page_title' => 'User Controller',
        ]);
    }

    #[Route('/dashboard/addUser', methods: 'post')]
    public function addUser(UserRepository $userRepository, Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, AdminRepository $admin): Response
    {
        try {
            if (json_last_error() !== JSON_ERROR_NONE) {
                return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
            }

            $json = $request->getContent();
            $data = json_decode($json);
            $olduser = $userRepository->findOneBy(['name' => $data->name]);

            if ($olduser) {
                return new JsonResponse(['status' => 'Error', 'message' => 'User already exist'], Response::HTTP_OK);
            }

            $User = new User();
            $adminid = $admin->find($data->adminid);

            $User->setName($data->name);
            $User->setPassword($data->password);
            $User->setStatus($data->status);
            $User->setAdminid($adminid);

            $errors = $validator->validate($User);
            if (count($errors) > 0) {
                return new JsonResponse(['status' => 'Error', 'message' => 'Validation error'], Response::HTTP_BAD_REQUEST);
            }

            $entityManager->persist($User);
            $entityManager->flush();

            // print_r($data);exit;
            return new JsonResponse(['status' => 'Success', 'message' => 'User inserted successfully'], Response::HTTP_OK);
        } catch (\Exception $e) {
            // Return an error response if something goes wrong
            return new JsonResponse(['status' => 'Error', 'message' => 'Failed to insert data'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/dashboard/getUsers', methods: 'get')]
    public function getUsers(UserRepository $userRepository, SerializerInterface $serializer, Request $request): Response
    {
        if ($request->headers->get('X-H') !== '1234') {
            return $this->json(['error' => 'Unauthorized'], 401);
        }
        // print_r('somedata');exit;
        $User = $userRepository->findAll();

        $UserData = $serializer->serialize($User, "json", ['groups' => 'user']);
        // dump($UserData);exit;
        return new JsonResponse(['getUser' => $UserData], Response::HTTP_OK);
    }

    #[Route('/dashboard/updateUser', methods: 'post')]
    public function updateUser(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, UserRepository $UserRepository): Response
    {
        try {
            if (json_last_error() !== JSON_ERROR_NONE) {
                return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
            }

            $json = $request->getContent();
            $data = json_decode($json);

            $User = $UserRepository->find($data->id);

            // print_r($User);exit;
            $User->setName($data->name);
            $User->setPassword($data->password);
            $User->setStatus($data->status);

            $errors = $validator->validate($User);
            if (count($errors) > 0) {
                return new JsonResponse(['status' => 'Error', 'message' => 'Validation error'], Response::HTTP_BAD_REQUEST);
            }

            $entityManager->persist($User);
            $entityManager->flush();

            // print_r($data);exit;
            return new JsonResponse(['status' => 'Success', 'message' => 'User updated successfully'], Response::HTTP_OK);
        } catch (\Exception $e) {
            // Return an error response if something goes wrong
            print_r($e->getMessage());
            return new JsonResponse(['status' => 'Error', 'message' => 'Failed to insert data'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/dashboard/deleteUser', methods: 'delete')]
    public function deleteUser(Request $request, UserRepository $UserRepository, EntityManagerInterface $entityManager): Response
    {
        if ($request->headers->get('X-H') !== '1234') {
            return $this->json(['error' => 'Unauthorized'], 401);
        }

        $json = $request->getContent();
        $data = json_decode($json);
        $User = $UserRepository->find($data->deleteDataId);
        $entityManager->remove($User);
        $entityManager->flush();
        // print_r($User);exit;
        return new JsonResponse(['status' => 'Success', 'message' => 'User deleted successfully'], Response::HTTP_OK);
    }
}
