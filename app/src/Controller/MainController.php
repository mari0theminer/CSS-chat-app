<?php

namespace App\Controller;

use App\Repository\ChatRoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="home")
     */
    public function index(ChatRoomRepository  $repository): Response
    {
        $allChatRomms = $repository->findAll();
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'allChatRoms'=> $allChatRomms
        ]);
    }
}
