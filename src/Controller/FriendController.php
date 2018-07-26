<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
    
class FriendController extends Controller
{
	/**
	 * @Route("/follow/show")
	 */
	public function show()
	{
		$user = $this->getUser();

		return $this->render('follow/show.html.twig', array(
			'user' =>$user,
		));
	}
    /**
	 * @Route("/follow/{id}", requirements={"id" = "\d+"})
	 */
	public function follow(Request $request, User $friend)
	{
		$isFollow = false;
		$user = $this -> get('security.token_storage') -> getToken() -> getUser();

		$em = $this -> getDoctrine() -> getManager();

		if($user->hasFollow($friend))
		{
			$user->removeFollow($friend);
			$isFollow = false;
		}
		else
		{
			$user->addFollow($friend);

			// $em = $this -> getDoctrine() -> getManager();
			
			$isFollow = true;
		}

		$em->persist($user);
		$em->flush();

		if ($request -> isXmlHttpRequest()) // Si c'est de l'AJAX
		{
			return new JsonResponse(array(
				'success' => true,
				
				'isFollow' => $isFollow
			));
		}
		/*return $this->render('follow/show.html.twig', array(
			'user' => $user,
		));*/
		return $this -> redirectToRoute('app_friend_show', array('id' => $friend-> getId()));
	}
}