<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Repository\AdminRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AdminController extends AbstractController
{
    #[Route('/dashboard/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'page_title' => 'Admin Controller',
        ]);
    }

    #[Route('/dashboard/addAdmin', methods: 'post')]
    public function addAdmin(AdminRepository $adminRepository, Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {
        try {
            if (json_last_error() !== JSON_ERROR_NONE) {
                return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
            }

            $json = $request->getContent();
            $data = json_decode($json);
            $oldadmin = $adminRepository->findOneBy(['name' => $data->name]);

            if($oldadmin){
                return new JsonResponse(['status' => 'Error', 'message' => 'Admin already exist'], Response::HTTP_OK);
            }

            $admin = new Admin();

            $admin->setName($data->name);
            $admin->setPassword($data->password);
            $admin->setAdmintype($data->type);
            $admin->setAdminstatus($data->status);

            $errors = $validator->validate($admin);
            if (count($errors) > 0) {
                return new JsonResponse(['status' => 'Error', 'message' => 'Validation error'], Response::HTTP_BAD_REQUEST);
            }

            $entityManager->persist($admin);
            $entityManager->flush();

            // print_r($data);exit;
            return new JsonResponse(['status' => 'Success', 'message' => 'Admin inserted successfully'], Response::HTTP_OK);
        } catch (\Exception $e) {
            // Return an error response if something goes wrong
            return new JsonResponse(['status' => 'Error', 'message' => 'Failed to insert data'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/dashboard/getAdmin', methods: 'get')]
    public function getAdmin(AdminRepository $adminRepository, SerializerInterface $serializer, Request $request): Response
    {
        if ($request->headers->get('X-H') !== '1234') {
            return $this->json(['error' => 'Unauthorized'], 401);
        }
        // print_r('somedata');exit;
        $admin = $adminRepository->findAll();
        $adminData = $serializer->serialize($admin, 'json', ['groups' => 'admin']);
        return new JsonResponse(['getAdmin' => $adminData], Response::HTTP_OK);
    }

    #[Route('/dashboard/updateAdmin', methods: 'post')]
    public function updateAdmin(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, AdminRepository $adminRepository): Response
    {
        try {
            if (json_last_error() !== JSON_ERROR_NONE) {
                return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
            }

            $json = $request->getContent();
            $data = json_decode($json);

            $admin = $adminRepository->find($data->id);

            // print_r($admin);exit;
            $admin->setName($data->name);
            $admin->setPassword($data->password);
            $admin->setAdmintype($data->admintype);
            $admin->setAdminstatus($data->adminstatus);

            $errors = $validator->validate($admin);
            if (count($errors) > 0) {
                return new JsonResponse(['status' => 'Error', 'message' => 'Validation error'], Response::HTTP_BAD_REQUEST);
            }

            $entityManager->persist($admin);
            $entityManager->flush();

            // print_r($data);exit;
            return new JsonResponse(['status' => 'Success', 'message' => 'Admin updated successfully'], Response::HTTP_OK);
        } catch (\Exception $e) {
            // Return an error response if something goes wrong
            print_r($e->getMessage());
            return new JsonResponse(['status' => 'Error', 'message' => 'Failed to insert data'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/dashboard/deleteAdmin', methods: 'delete')]
    public function deleteAdmin(Request $request, AdminRepository $adminRepository, EntityManagerInterface $entityManager): Response
    {
        if ($request->headers->get('X-H') !== '1234') {
            return $this->json(['error' => 'Unauthorized'], 401);
        }

        $json = $request->getContent();
        $data = json_decode($json);
        $admin = $adminRepository->find($data->deleteDataId);
        $entityManager->remove($admin);
        $entityManager->flush();
        // print_r($admin);exit;
        return new JsonResponse(['status' => 'Success', 'message' => 'Admin deleted successfully'], Response::HTTP_OK);
    }
}
