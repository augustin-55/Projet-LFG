<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Groupe;
use App\Entity\User;


class UserController extends Controller
{
    /**
     * @Route("/", name="app")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $groupes = $em->getRepository(Groupe::class)->findAll();

        $users = $em->getRepository(User::class)->findAll();

        $images = $em->getRepository(User::class)->findAll();

        return $this->render('index.html.twig', 
        [
            'groupes' => $groupes,
            'users' => $users,
            'images' => $images
        ]
    );
    }
}

