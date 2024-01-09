<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class YoutubeController extends AbstractController
{
    #[Route('/youtube', name: 'app_turbotattoo3000')]
    public function index(): Response
    {
        return $this->render('youtube/index.html.twig', [

            'youtube' => 'Stan Dottori',
        ]);
    }
}
