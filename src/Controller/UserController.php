<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Groupe;



class UserController extends Controller
{
    /**
     * @Route("/", name="app")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $groupes = $em->getRepository(Groupe::class)->findall();

        return $this->render('index.html.twig', 
        [
            'groupes' => $groupes,
        ]
    );
    }
}

