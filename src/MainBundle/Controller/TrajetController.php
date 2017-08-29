<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Trajet;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TrajetController extends Controller
{

    /**
     * @Route("/trajet/", name="admin_trajets")
     */
    public function adminTrajetsAction()
    {
        $idCompagnie=$this->container->get('main_myCustomServices')->getCurentCompagnieId();
        $this->get("request_stack")->getCurrentRequest()->getSession()->set('idCompagnie',$idCompagnie);
        //$_SESSION['idCompagnie']=$idCompagnie;

        return $this->render('MainBundle:MesVues:adminTrajets.html.twig',array('idCompagnie'=>$idCompagnie));
    }


    /**
     * @Route("/trajet/nouveau", name="trajet_nouveau")
     */
    public function nouveauAction()
    {
        $em=$this->getDoctrine()->getManager();
        $repositCompagnie=$em->getRepository("MainBundle:Compagnie");
        $idCompagnie=$this->requestStack->getCurrentRequest()->getSession()->get('idCompagnie');
        $compagnie=$repositCompagnie->find($idCompagnie);

        $trajet=new Trajet();
        $trajet->setCompagnie($compagnie);

        $form=$this->createForm("MainBundle\Form\TrajetType",$trajet);

        $req=$this->get("request_stack");

        if ($req->getCurrentRequest()->getMethod() == 'POST')
        {
            $form->handleRequest($req->getCurrentRequest());
            if ($form->isValid())
            {
                $em->persist($trajet);
                $em->flush();

                return $this->redirect($this->generateUrl("admin_trajets"));

            }
        }

        return $this->render('MainBundle:MesVues:modeleNouveau.html.twig',array(
            'form'=>$form->createView(),
            'ent'=>'TRAJET'));
    }


    /**
     * @Route("/trajet/modifier/id={idTrajet}", name="trajet_modifier")
     */
    public function modifierAction($idTrajet)
    {
        $em=$this->getDoctrine()->getManager();
        //$idCompagnie=$this->requestStack->getCurrentRequest()->getSession()->get('idCompagnie');

        $repositTrajet=$em->getRepository("MainBundle:Trajet");

        $trajet=$repositTrajet->find($idTrajet);

        $form=$this->createForm("MainBundle\Form\TrajetType",$trajet);

        $req=$this->get("request_stack");

        if ($req->getCurrentRequest()->getMethod() == 'POST')
        {
            $form->handleRequest($req->getCurrentRequest());
            if ($form->isValid())
            {
                $em->persist($trajet);
                $em->flush();

                return $this->redirect($this->generateUrl("admin_trajets"));
            }
        }

        return $this->render('MainBundle:MesVues:modeleNouveau.html.twig',array(
            'form'=>$form->createView(),
            'ent'=>'AUTOBUS'));
    }

    /**
     * @Route("/trajet/supprimer/id={idTrajet}", name="trajet_supprimer")
     */
    public function supprimerAction($idTrajet)
    {
        $em=$this->getDoctrine()->getManager();

        $repositTrajet=$em->getRepository("MainBundle:Trajet");

        $trajet=$repositTrajet->find($idTrajet);

        if ($trajet !== null)
        {
            $em->remove($trajet);
            $em->flush();
            return $this->redirect($this->generateUrl("admin_trajets"));

        }

    }


    /**
     * @param $idCompagnie
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listeByCompagnieAction($idCompagnie)
    {
        $em=$this->getDoctrine()->getManager();
        $repositTrajet=$em->getRepository('MainBundle:Trajet');

        $listeTrajets=$repositTrajet->findByCompagnie($idCompagnie);

        return $this->render("MainBundle:MesVues:listeTrajet.html.twig",array(
            'listeTrajets'=>$listeTrajets
        ));

    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listeTrajetsAction()
    {
        $em=$this->getDoctrine()->getManager();
        $repositTrajet=$em->getRepository('MainBundle:Trajet');
        $idCompagnie=$this->requestStack->getCurrentRequest()->getSession()->get('idCompagnie');

        $listeTrajets=$repositTrajet->findBy(array('compagnie'=>$idCompagnie));

        return $this->render("MainBundle:MesVues:listeTrajet.html.twig",array(
            'listeTrajets'=>$listeTrajets
        ));

    }
}
