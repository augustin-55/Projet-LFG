<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Message;

/**
 * @Route("/chat")
 */
class ChatController extends Controller
{
    /**
     * @Route("/", name="chat")
     */
    public function index()
    {
        return $this->render('chat/index.html.twig', [
            'controller_name' => 'ChatController',
            'ws_url' => 'localhost:8889',
        ]);
    }

    /**
     * @Route("/getmessage", name="chat_get")
     */
    public function getMessage()
    {
        $em = $this
                ->getDoctrine()
                ->getManager();

        $messages = $em
                ->getRepository(Message::class)
                ->findLastMessages($this->getUser());
        
        $messagesArray = array();
        foreach ($message as $messages) {
            $messagesArray[] = array(
                'id' => $message->getId(),
                'message' => $message->getMessage(),
                'user' => array(
                    'id' => $message->getUser()->getId(),
                    'username' => $message->getUser()->getUsername(),
                )
            );
        }

        return new JsonResponse(array(
            'success' => true,
            'messages' => $messagesArray,
        ));

    }

    /**
     * @Route("/messagerie", name="chat_post")
     */
    public function messagerie(Request $request)
    {
        $user = $this->getUser();
        $message = new Message();
        $message->setUser($user);

        // Création du formulaire de message
        $formBuilder = $this->createFormBuilder()
            ->setAction($this->generateUrl('chat_post'))
            ->setMethod('POST')
            ->add('destinataires', EntityType::class, array(
                'label' => 'Destinataire',
                'multiple' => true,
                'choices' => $user->getfriendFollow(),
                'class' => 'App\\Entity\\User'
            ))
            ->add('message', Type\TextareaType::class, array(
                'attr' => array('placeholder' => 'Message'),
            ));

        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        // Get messages
        $em = $this->getDoctrine()->getManager();
        $messagesRecus = $em->getRepository(Message::class)->findMessageRecus($user);

        $messagesEnvoyes = $em->getRepository(Message::class)->findBy(
            ['user' => $user],
            ['id' => 'DESC'],
            30
        );

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData(); // Données du formulaire envoyé
            $message->setMessage($formData['message']);

            
            $em->persist($message);
            $em->flush();

            $t = $this->get('translator');
            $this->addFlash('success', $t->trans('message.send_success', array(
            )));

            return $this->redirectToRoute('homepage');
        }

        return $this->render('chat/messagerie.html.twig', array(
            'form' => $form->createView(),
            'messagesRecus' => $messagesRecus,
            'messagesEnvoyes' => $messagesEnvoyes,
        ));
    }
}
