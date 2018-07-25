<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Groupe;

class GroupeController extends Controller
{
    /**
     * @Route("/join/{id}", name="join")
     */
    public function join(Groupe $groupe)
    {
        $user = $this->getUser();
        $user->addGroupe($groupe);

        $em = $this->getdoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('app');
    }

    /**
     * @Route("/removeJoin/{id}", name="removeJoin")
     */
    public function removeJoin(Groupe $groupe)
    {
        $user = $this->getUser();
        $user->removeGroupe($groupe);
        $em = $this->getdoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('app');
    }
}
