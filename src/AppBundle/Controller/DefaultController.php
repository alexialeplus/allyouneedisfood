<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $default = array('default' => 'Your search here');
        $form = $this->createFormBuilder()
            ->setMethod('GET')
            ->add('search', TextType::class, array('label' => false))
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        /*if ($form->isSubmitted() && $form->isValid()) {

        }*/

        return $this->render('AppBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
            )
        );
    }
}
