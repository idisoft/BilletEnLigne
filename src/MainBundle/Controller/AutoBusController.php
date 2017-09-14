<?php

namespace MainBundle\Controller;

use MainBundle\Entity\AutoBus;
use MainBundle\Form\AutoBusType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AutoBusController extends Controller
{

    /**
     * @Route("/autobus/nouveau", name="autoBus_nouveau")
     */
    public function nouveauAction()
    {
        $em=$this->getDoctrine()->getManager();
        $repositCompagnie=$em->getRepository("MainBundle:Compagnie");
        $req=$this->get("request_stack");

        $idCompagnie=$req->getCurrentRequest()->getSession()->get('idCompagnie');

        $compagnie=$repositCompagnie->find($idCompagnie);

        $autoBus=new AutoBus();
        $autoBus->setCompagnie($compagnie);

        $form=$this->createForm("MainBundle\Form\AutoBusType",$autoBus);



        if ($req->getCurrentRequest()->getMethod() == 'POST')
        {
            $form->handleRequest($req->getCurrentRequest());
            if ($form->isValid())
            {
                $em->persist($autoBus);
                $em->flush();

                return $this->redirect($this->generateUrl("compagnie_details",array('idCompagnie'=>$idCompagnie)));
            }
        }

        return $this->render('MainBundle:MesVues:modeleNouveau.html.twig',array(
            'form'=>$form->createView(),
            'ent'=>'AUTOBUS'));
    }

    /**
     * @Route("/autobus/modifier/id={idAutoBus}", name="autoBus_modifier")
     */
    public function modifierAction($idAutoBus)
    {
        $em=$this->getDoctrine()->getManager();
        $idCompagnie=$this->get("request_stack")->getCurrentRequest()->getSession()->get('idCompagnie');

        $repositAutoBus=$em->getRepository("MainBundle:AutoBus");

        $autoBus=$repositAutoBus->find($idAutoBus);

        $form=$this->createForm("MainBundle\Form\AutoBusType",$autoBus);

        $req=$this->get("request_stack");

        if ($req->getCurrentRequest()->getMethod() == 'POST')
        {
            $form->handleRequest($req->getCurrentRequest());
            if ($form->isValid())
            {
                $em->persist($autoBus);
                $em->flush();

                return $this->redirect($this->generateUrl("compagnie_details",array('idCompagnie'=>$idCompagnie)));

            }
        }

        return $this->render('MainBundle:MesVues:modeleNouveau.html.twig',array(
            'form'=>$form->createView(),
            'ent'=>'AUTOBUS'));
    }

    /**
     * @Route("/autobus/supprimer/id={idAutoBus}", name="autoBus_supprimer")
     */
    public function supprimerAction($idAutoBus)
    {
        $em=$this->getDoctrine()->getManager();

        $idCompagnie=$this->get("request_stack")->getCurrentRequest()->getSession()->get('idCompagnie');

        $repositAutoBus=$em->getRepository("MainBundle:AutoBus");

        $autoBus=$repositAutoBus->find($idAutoBus);

        if ($autoBus !== null)
        {
            $em->remove($autoBus);
            $em->flush();
            return $this->redirect($this->generateUrl("compagnie_details",array('idCompagnie'=>$idCompagnie)));

        }

    }

    /**
     * @param $idCompagnie
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listeByCompagnieAction($idCompagnie)
    {
        $em=$this->getDoctrine()->getManager();
        $repositAutoBus=$em->getRepository('MainBundle:AutoBus');

        $listeAutoBus=$repositAutoBus->findBy(array('compagnie'=>$idCompagnie));

        return $this->render("MainBundle:MesVues:listeAutoBus.html.twig",array(
            'listeAutoBus'=>$listeAutoBus
        ));

    }
}
