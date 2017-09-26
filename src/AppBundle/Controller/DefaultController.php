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
            ->add('search', TextType::class, array('label' => false, 'attr' => array('placeholder' => 'Tapez votre ingrédient ici')))
            ->add('Ok', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $result = $request->query->get('form');
            $userSearch = $result['search'];

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "http://localhost/api/api.php?q=" . $userSearch);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($curl);
            $searchResult = json_decode($response, true);

            return $this->render('AppBundle:Default:index.html.twig', array(
                'form' => $form->createView(),
                'results' => $searchResult,
                )
            );

        }

        return $this->render('AppBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
            )
        );
    }


    /**
     * @Route("/{id}", name="show_product")
     */
    public function show($id) {
        if (isset($id) && is_numeric($id)) {

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "http://localhost/api/api.php?id=" . $id);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($curl);
            $productDetail = json_decode($response, true);

            dump($productDetail);
        }

        return $this->render('AppBundle:Default:show.html.twig', array(
            'product' => $productDetail, 
            )
        );
    }
}
