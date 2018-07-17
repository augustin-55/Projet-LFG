<?php
// src/Controller/UserController.php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{

    /**
     * @Route("/")
     */
    public function userAction()
    {
        return $this->render('index.html.twig');
    }
    
}

