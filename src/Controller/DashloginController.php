<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashloginController extends AbstractController
{
    #[Route('/dashboard/login', name: 'app_dashlogin')]
    public function index(): Response
    {
        return $this->render('dashlogin/index.html.twig', [
            'page_title' => 'Dashlogin Controller',
        ]);
    }
}
