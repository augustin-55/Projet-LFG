<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Groupe;
use App\Form\GroupeType;

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

    /**
     * @Route("/add", name="add_groupe")
     */
    public function add(Request $request)
    {
        // Chargement du formulaire de groupe
        $groupe = new Groupe(); // Nouveau groupe
        $groupe->setUser($this->getUser()); // Définis l'utilisateur courant comme créateur du groupe
        $form = $this->createForm(GroupeType::class, $groupe); // Crée un nouveau form à partir de la classe GroupeType
        $form->handleRequest($request); // Mettre les POST dans le formulaire
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($groupe);
            $em->flush();

            $this->addFlash('success', 'Le groupe a bien été ajouté');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('group/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
