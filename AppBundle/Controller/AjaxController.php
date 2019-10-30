<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class AjaxController extends Controller
{
    /**
     * @Route("/get_post/ajax")
     */
    public function AjaxAction(Request $request)
    {

    	$students = $this->getDoctrine()
    	->getManager()
      	->getRepository('AdminBundle:Post') 
      	->findAll();  


   if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {  
      $jsonData = array();  
      $idx = 0;  
      foreach($students as $student) {  
         $temp = array(
            'name' => $student->getTitle(),  
            'address' => $student->getBody(),  
         );   
         $jsonData[$idx++] = $temp;  

      } 
      return new JsonResponse($jsonData); 
   } else { 
      return $this->render('AppBundle:Ajax:ajax.html.twig'); 
   } 



    }

}
