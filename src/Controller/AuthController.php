<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 *
 * @Route("/api")
 */
class AuthController extends AbstractController
{
    /**
     *
     * @Route("/login",name="login",methods={"POST"})
     */
    public function login(): Response
    {   if(!$this->getUser() ) {
        return $this->json(["message" => "Identifiants Incorrect !"], 200, []);
    }
        return $this->json(["message" =>"bienvenue"], 200,["groups"=> "users"]);
    }

    /**
     *
     * @Route("/logout",name="logout",methods={"POST"})
     */
    public function logout(): Response
    {   if(!$this->getUser() ) {
        return $this->json(["message" => "Un probleme est survenue ! !"], 200, []);
    }
        return $this->json(['message' => 'Vous etes deconécté !'], 200,[]);
    }
}
