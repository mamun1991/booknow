<?php

namespace App\Controller;

use App\Repository\AdminRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(): Response
    {
        return $this->render('login/index.html.twig', [
            'page_title' => 'Login Controller',
        ]);
    }

    #[Route('/loginAuth', name: 'login')]
    public function loginAuth(Request $request, AdminRepository $adr, SerializerInterface $serializer): Response
    {
        if ($request->headers->get('X-H') !== 'booknow1221') {
            return $this->json(['error' => 'Unauthorized'], 401);
        }

        $json = $request->getContent();
        $data = json_decode($json);

        // print_r($data->login->name);exit;

        $logdata = $adr->findByNameAndPassword($data->login->name, $data->login->password);
        if (!$logdata) {
            return new JsonResponse(['status' => 'Error', 'message' => 'No match found!'], Response::HTTP_OK);
        }
        
        $login = $serializer->serialize($logdata, "json", ['groups' => 'admin']);
        // print_r($login); exit;
        return new JsonResponse(['loginsuccess' => $login, 'status' => 'Success'], Response::HTTP_OK);
    }
}
