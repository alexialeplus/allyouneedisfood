<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $default = array('default' => 'Your search here');
        $form = $this->createFormBuilder($default)
            ->add('search', TextType::class)
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        /*if ($form->isSubmitted() && $form->isValid()) {

        }*/

        return $this->render('AppBundle:Default:index.html.twig', array(
            'form' => $form,
            )
        );
    }
}
