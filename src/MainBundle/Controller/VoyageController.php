<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Voyage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VoyageController extends Controller
{

    /**
     * @Route("/voyage/", name="admin_voyage")
     */
    public function adminVoyageAction()
    {
        //j'initialise mon env idCompagnie, idUser pour adapter l'env à celui qui est connecté
        $this->get('main_mycustomservices')->initEnv();

        return $this->render('MainBundle:MesVues:adminVoyage.html.twig');
    }

    /**
     * @Route("/voyage/nouveau", name="voyage_nouveau")
     */
    public function nouveauAction()
    {
        $em=$this->getDoctrine()->getManager();

        $voyage=new Voyage();

        $form=$this->createForm("MainBundle\Form\VoyageType",$voyage);

        $req=$this->get("request_stack");


        if ($req->getCurrentRequest()->getMethod() == 'POST')
        {
            $form->handleRequest($req->getCurrentRequest());
            if ($form->isValid())
            {

                $em->persist($voyage);
                $em->flush();

                return $this->redirect($this->generateUrl("admin_voyage"));

            }
        }

        return $this->render('MainBundle:MesVues:modeleNouveau.html.twig',array(
            'form'=>$form->createView(),
            'ent'=>'PARCOURS'));
    }


    /**
     * @Route("/voyage/modifier/id={idVoyage}", name="voyage_modifier")
     */
    public function modifierAction($idVoyage)
    {
        $em=$this->getDoctrine()->getManager();

        $repositVoyage=$em->getRepository("MainBundle:Voyage");

        $voyage=$repositVoyage->find($idVoyage);

        $form=$this->createForm("MainBundle\Form\VoyageType",$voyage);

        $req=$this->get("request_stack");



        if ($req->getCurrentRequest()->getMethod() == 'POST')
        {
            $form->handleRequest($req->getCurrentRequest());
            if ($form->isValid())
            {
                $em->persist($voyage);
                $em->flush();

                return $this->redirect($this->generateUrl("admin_voyage"));

            }
        }

        return $this->render('MainBundle:MesVues:modeleNouveau.html.twig',array(
            'form'=>$form->createView(),
            'ent'=>'AUTOBUS'));
    }


    /**
     * @Route("/voyage/supprimer/id={idVoyage}", name="voyage_supprimer")
     */
    public function supprimerAction($idVoyage)
    {
        $em = $this->getDoctrine()->getManager();

        $repositVoyage = $em->getRepository("MainBundle:Voyage");

        $voyage = $repositVoyage->find($idVoyage);

        if ($voyage !== null) {
            $em->remove($voyage);
            $em->flush();
            return $this->redirect($this->generateUrl("admin_voyage"));

        }

    }

    /**
     * @param $idVoyage
     * @Route("/voyage/detail/id={idVoyage}", name="voyage_details")
     */
    public function detailsAction($idVoyage)
    {
        $em=$this->getDoctrine()->getManager();
        $repositVoyage=$em->getRepository('MainBundle:Voyage');

        $voyage=$repositVoyage->find($idVoyage);
        if ($voyage == null)
        {
            $this->get('session')->getFlashBag()->add(
                'alert_info',
                'Ce voyage n\'existe pas');
        }

        $_SESSION['idVoyage']=$idVoyage;

        return $this->render("MainBundle:MesVues:voyageDetails.html.twig",array(
            'voyage'=>$voyage
        ));

    }


    /**
     * @param $idCompagnie
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listeByCompagnieAction($idCompagnie)
    {
        $em=$this->getDoctrine()->getManager();
        $repositVoyage=$em->getRepository('MainBundle:Voyage');

        $listeVoyages=$repositVoyage->findByCompagnie($idCompagnie);

        return $this->render("MainBundle:MesVues:listeVoyage.html.twig",array(
            'listeVoyages'=>$listeVoyages
        ));

    }


    public function listeVoyagesByStatusAction($status)
    {

        $idCompagnie=$this->container->get('main_myCustomServices')->getCurentCompagnieId();

        $em=$this->getDoctrine()->getManager();
        $repositVoyage=$em->getRepository('MainBundle:Voyage');

        $listeVoyages=$repositVoyage->findVoyageByStatus($status,$idCompagnie);

        return $this->render("MainBundle:MesVues:listeVoyage.html.twig",array(
            'listeVoyages'=>$listeVoyages
        ));

    }
}
