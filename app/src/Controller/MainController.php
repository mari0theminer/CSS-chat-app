<?php

namespace App\Controller;

use App\Repository\ChatRoomRepository;
use mysql_xdevapi\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {

            return $this->redirectToRoute('chat_hash',['hash'=>'MAIN_CHAT']);
        }

}
