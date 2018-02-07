<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Announce;
use AppBundle\Entity\Category;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



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
   
    public function listAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        
        $announces = $em->getRepository('AppBundle:Announce')->findAll();
        
        $form = $this->createFormBuilder()
            ->add('search', SearchType::class, array(
                'required'=> false,
            ))
            ->add('categories', EntityType::class, array(
                'class' => 'AppBundle:Category',
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $er) {
                    $query = $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'placeholder' => 'Toutes les catégories',

                'expanded' => false,
                'multiple' => false,
                'required' => false,
            ))
            ->getForm();
             $form->handleRequest($request);

        $parameter1 = "";
        if($form->isSubmitted() && $form->isValid() ) {
            $data = $form->getData();
           
            $parameter1 = $data['search'];
            $parameter2 = $data['categories'];
            
            if(!$parameter2){
                    $announces = $em->getRepository('AppBundle:Announce')->getAnnouncesTitle($parameter1);
                // $query = $em->createQuery(
                //     'select a from AppBundle\Entity\Announce as a
                //     where a.title like :p')
                //     ->setParameter('p', '%'.$parameter1.'%');
                }
            else {
                    $id = $parameter2->getId();
                    $announces = $em->getRepository('AppBundle:Announce')->getAnnouncesTitleCategory($parameter1, $id);
            //     $id = $parameter2->getId();
            //     $query = $em->createQuery(
            //         'select a from AppBundle\Entity\Announce as a
            //         join AppBundle\Entity\Category as c 
            //         with a.category = c.id
            //         where c.id = :id
            //         and a.title like :p')
            //     ->setParameter('p', '%'.$parameter1.'%')
            //     ->setParameter('id', $id);
            }
            
            // $announces = $query->getResult();
            
        }

        return $this->render('announce/list.html.twig', array(
            'announces' => $announces,
            'form' => $form->createView()
            

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