<?php

namespace App\Controller;

use App\Form\CreateChatType;
use App\Repository\ChatRoomRepository;
use Doctrine\ORM\EntityManagerInterface;
use mysql_xdevapi\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MainController
 * @package App\Controller
 * @Route("/chat")
 */
class ChatController extends AbstractController
{
    /**
     * @Route("/create", name="chat_create")
     */
    public function index(Request $request,EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CreateChatType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $chat = $form->getData();


            $em->persist($chat);
            $em->flush();

            return $this->redirectToRoute('home');
        }
        return $this->render('chat/CreateChat.html.twig', [
            'controller_name' => 'MainController',
            'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/c/{hash}", name="chat_hash")
     */
    public function chat_hash($hash,ChatRoomRepository $re): Response
    {
        try {
            $room =$re->findOneBy(['hash'=>$hash]);

        }catch (Exception $exception){
            return $this->redirectToRoute('home');
        }
        $allrooms =$re->findAll();


        return $this->render('chat/joinChat.twig',
            [
                'room'=>$room,
                'rooms'=>$allrooms
            ]);

    }
}
