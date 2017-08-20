<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RechercheIndexController extends Controller
{
    /*public function rechercheAction()
    {
        $em=$this->getDoctrine()->getManager();
        $form=$this->createForm("MainBundle\Form\RechercheParcoursType");

        $requete=$this->get('request_stack');

        $datas=null;
        if ($requete->getCurrentRequest()->getMethod()=='POST')
        {
                $form->handleRequest($requete->getCurrentRequest());
                if ($form->isValid())
                {

                    //On récupère les données entrées dans le formulaire par l'utilisateur
                    $datas = $this->get('request_stack')->getCurrentRequest()->request->get('sco_mainbundle_recherche_type');

                    $compagnie = $datas['compagnie'];
                    $source = $datas['source'];
                    $destination = $datas['destination'];
                    $dateDepart = $datas['dateDepart'];



                    return $this->render('MainBundle:MesVues:RechercheForm.html.twig',array(
                                         'form'=>$form->createView()));
                }
        }



        return $this->render('MainBundle:MesVues:RechercheForm.html.twig',
                            array('form'=>$form->createView()));
    }*/

}
