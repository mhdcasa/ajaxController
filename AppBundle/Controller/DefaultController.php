<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Component\HttpFoundation\Response;

use AppBundle\Services\mathService;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }


    /**
     * @Route("/admin/", name="admin")
     */
    public function adminAction()
    {
        return $this->render('default/admin.html.twig');
    }

    /**
     * @Route("/math_service/", name="math_service")
     */
    public function claculatAction(mathService $math_service_object)
    {
        
        return new Response($math_service_object->addition(5,2));
    }



    /**
     * @Route("/contact/", name="contact")
     * @Method({"GET", "POST"})
     */
    public function contactAction(Request $request, \Swift_Mailer $mailer)
    {

        $form = $this->createFormBuilder()
            ->add('from')
            ->add('subject')
            ->add('body',textareaType::class)
            ->add('Send', SubmitType::class)
            ->getForm();

            $form->handleRequest($request);


        if ($form->isSubmitted()) {

            $data = $form->getData();

          // Create the message
          $message = (new \ Swift_Message())

          // Give the message a subject
          ->setSubject($data['subject'])

          // Set the From address with an associative array
          ->setFrom($data['from'])

          // Set the To addresses with an associative array (setTo/setCc/setBcc)
          ->setTo('mnaimi25@gmail.com')

          // Give it a body
          ->setBody($data['body'],'text/plain');   

          $mailer->send($message);            
        } 


        return $this->render('default/contact.html.twig',['formulaire'=>$form->createView()] );
    }

}
