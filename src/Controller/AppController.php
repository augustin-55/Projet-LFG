<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Group;

class AppController extends Controller
{
    /**
     * @Route("/app", name="app")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $groups = $em->getRepository(Group::class)->findAll();

        return $this->render('app/index.html.twig', [

            'groups' => $groups
            
        ]);
    }
}
