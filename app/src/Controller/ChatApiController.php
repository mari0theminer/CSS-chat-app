<?php

namespace App\Controller;

use App\Entity\ChatMessage;
use App\Repository\ChatMessageRepository;
use App\Repository\ChatRoomRepository;
use Doctrine\ORM\EntityManagerInterface;
use mysql_xdevapi\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MainController
 * @package App\Controller
 * @Route("/chat/api")
 */
class ChatApiController extends AbstractController
{
    /**
     * @Route("/send/message", name="sende_message")
     */
    public function index(Request $request,EntityManagerInterface $em,ChatRoomRepository  $repository)
    {
        $respone =new Response();
        try {
            $json = json_decode($request->getContent());
            $user_room=$repository->findOneBy(['hash'=>$json->room]);
            $user_message=$json->message;
        }catch (Exception $exception){
            $respone->setStatusCode(404);
            return $respone;
        }
        if (strlen($user_message) >1){
            $respone->setStatusCode(204);
        }
        $message =new ChatMessage();
        $message->setChatRoom($user_room);
        $message->setText($user_message);
        $message->setSendFrom($this->getUser());
        $message->setCreatedAt(new \DateTime());
        $em->persist($message);
        $em->flush();
        $respone->setStatusCode(201);
        return $respone;

    }
    /**
     * @Route("/get/message", name="get_message")
     */
    public function get_message(Request $request, ChatMessageRepository  $repository,ChatRoomRepository  $Crepository)
    {
        $respone =new Response();
        $respone->setStatusCode(200);
        try {
            $json = json_decode($request->getContent());
            $user_room=$Crepository->findOneBy(['hash'=>$json->room]);
                $lastHash = $json->LastMessageHash;
        }catch (Exception $exception){
            $respone->setStatusCode(404);
            return $respone;
        }
        $messages =$repository->findBy(['ChatRoom'=>$user_room],["created_at"=>"ASC"]);
        if($messages[count($messages) -1]->getHash() === $lastHash ){
            return $respone;
        }
        $ob=[];
        foreach ($messages as $message){
            $ob[] = ["text"=>$message->getText(),"hash"=>$message->getHash(),"from"=>$message->getSendFrom()->getUsername(),"date"=>$message->getCreatedAt()->format("Y-m-d H:i:s")];
        }
        $respone->setContent(json_encode($ob));

        return $respone;

    }
}
