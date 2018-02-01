<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Announce;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


/**
 * Announce controller.
 *
 * @Route("/annonces")
 */
class AnnounceController extends Controller
{

/**
 * 
 *
 * @Route("/", name="announces_list")
 */
    // public function testAction(){

    //     return new Response('test');
    // }
    public function listAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        
        $announces = $em->getRepository('AppBundle:Announce')->findAll();
        
        $form = $this->createFormBuilder()
            ->add('search', SearchType::class)
            // ->add('rechercher', SubmitType::class)
            ->getForm();
             $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid() ) {
            $data = $form->getData();
            $parameter = $data['search'];
           $query = $em->createQuery(
               'select a from AppBundle\Entity\Announce as a
               where a.title like :p')
            ->setParameter('p', '%'.$parameter.'%');
            $announces = $query->getResult();
        }
       

        return $this->render('announce/list.html.twig', array(
            'announces' => $announces,
            'form' => $form->createView(),

        ));
    }

    /**
     * Affiche une annonce
     *
     * @Route("/{id}", name="announce_show")
     * @Method("GET")
     */
    public function showAction(Announce $announce)
    {
       

        return $this->render('announce/show.html.twig', array(
            'announce' => $announce,
            
        ));
    }
}