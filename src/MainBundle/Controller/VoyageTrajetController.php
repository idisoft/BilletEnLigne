<?php

namespace MainBundle\Controller;

use MainBundle\Entity\VoyageTrajet;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VoyageTrajetController extends Controller
{

    /**
     * @Route("/voyageTrajet/nouveau", name="voyageTrajet_nouveau")
     */
    public function nouveauAction()
    {
        $em=$this->getDoctrine()->getManager();
        $repositVoyage=$em->getRepository("MainBundle:Voyage");
        $idVoyage=$_SESSION['idVoyage'];
        $voyage=$repositVoyage->find($idVoyage);

        $voyageTrajet=new VoyageTrajet();
        $voyageTrajet->setVoyage($voyage);

        $form=$this->createForm("MainBundle\Form\VoyageTrajetType",$voyageTrajet);

        $req=$this->get("request_stack");

        if ($req->getCurrentRequest()->getMethod() == 'POST')
        {
            $form->handleRequest($req->getCurrentRequest());
            if ($form->isValid())
            {
                $voyageTrajet->setNbrePlaceRestant($voyageTrajet->getNbrePlaceInit());
                $em->persist($voyageTrajet);
                $em->flush();

                return $this->redirect($this->generateUrl("voyage_details",array('idVoyage'=>$idVoyage)));

            }
        }

        return $this->render('MainBundle:MesVues:modeleNouveau.html.twig',array(
            'form'=>$form->createView(),
            'ent'=>'TRAJET'));
    }


    /**
     * @Route("/voyageTrajet/modifier/id={idVoyageTrajet}", name="voyageTrajet_modifier")
     */
    public function modifierAction($idVoyageTrajet)
    {
        $em=$this->getDoctrine()->getManager();
        $idVoyage=$_SESSION['idVoyage'];

        $repositVoyageTrajet=$em->getRepository("MainBundle:VoyageTrajet");

        $voyageTrajet=$repositVoyageTrajet->find($idVoyageTrajet);

        $form=$this->createForm("MainBundle\Form\VoyageTrajetType",$voyageTrajet);

        $req=$this->get("request_stack");

        if ($req->getCurrentRequest()->getMethod() == 'POST')
        {
            $form->handleRequest($req->getCurrentRequest());
            if ($form->isValid())
            {
                if ($voyageTrajet->getNbrePlaceInit()<$voyageTrajet->getNbrePlaceRestant())
                {
                    $this->addFlash('alert_info','Cette compagnie n\'existe pas');
                    return;
                }

                $voyageTrajet->setNbrePlaceRestant($voyageTrajet->getNbrePlaceInit());
                $em->persist($voyageTrajet);
                $em->flush();

                return $this->redirect($this->generateUrl("voyage_details",array('idVoyage'=>$idVoyage)));

            }
        }

        return $this->render('MainBundle:MesVues:modeleNouveau.html.twig',array(
            'form'=>$form->createView(),
            'ent'=>'AUTOBUS'));
    }

    /**
     * @Route("/voyageTrajet/supprimer/id={idVoyageTrajet}", name="voyageTrajet_supprimer")
     */
    public function supprimerAction($idVoyageTrajet)
    {
        $em=$this->getDoctrine()->getManager();
        $idVoyage=$_SESSION['idVoyage'];

        $repositVoyageTrajet=$em->getRepository("MainBundle:VoyageTrajet");

        $voyageTrajet=$repositVoyageTrajet->find($idVoyageTrajet);

        if ($voyageTrajet !== null)
        {
            $em->remove($voyageTrajet);
            $em->flush();
            return $this->redirect($this->generateUrl("voyage_details",array('idVoyage'=>$idVoyage)));

        }

    }


    /**
     * @param $idVoyage
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listeByVoyageAction($idVoyage)
    {
        $em=$this->getDoctrine()->getManager();
        $repositVoyageTrajet=$em->getRepository('MainBundle:VoyageTrajet');

        $listeVoyageTrajets=$repositVoyageTrajet->findBy(array('voyage'=>$idVoyage));

        return $this->render("MainBundle:MesVues:listeVoyageTrajet.html.twig",array(
            'listeVoyageTrajets'=>$listeVoyageTrajets
        ));

    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listeVoyageTrajetsAction()
    {
        $em=$this->getDoctrine()->getManager();
        $repositVoyageTrajet=$em->getRepository('MainBundle:VoyageTrajet');

        $listeVoyageTrajets=$repositVoyageTrajet->findBy(array('compagnie'=>$_SESSION['idCompagnie']));

        return $this->render("MainBundle:MesVues:listeVoyageTrajet.html.twig",array(
            'listeVoyageTrajets'=>$listeVoyageTrajets
        ));

    }
}
