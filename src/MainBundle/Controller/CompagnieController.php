<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Compagnie;
use MainBundle\Form\CompagnieType;
use MainBundle\MainBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CompagnieController extends Controller
{
    /**
     * @Route("/compagnie/", name="admin_compagnie")
     */
    public function adminAction()
    {

        $response=$this->render("MainBundle:MesVues:compagnieAdmin.html.twig");
        return $response;
    }

    /**
     * @Route("/compagnie/nouveau/",name="compagnie_nouveau")
     */
    public function nouveauAction()
    {


        $em=$this->getDoctrine()->getManager();

        $compagnie= new Compagnie();

        $form=$this->createForm("MainBundle\Form\CompagnieType", $compagnie);



        $req=$this->get("request_stack");



        if ($req->getCurrentRequest()->getMethod()=='POST'){

            $form->handleRequest($req->getCurrentRequest());
            if ($form->isValid()){
                $em->persist($compagnie);
                $em->flush();
                return $this->redirect($this->generateUrl("admin_compagnie"));
            }
        }

        return $this->render('MainBundle:MesVues:modeleNouveau.html.twig',array(
            'form'=>$form->createView(),
            'ent'=>'COMPAGNIE'));

    }

    /**
     * @param $idCompagnie
     * @Route("/compagnie/detail/id={idCompagnie}", name="compagnie_details")
     */
    public function detailsAction($idCompagnie)
    {
        $em=$this->getDoctrine()->getManager();
        $repositCompagnie=$em->getRepository('MainBundle:Compagnie');

        $compagnie=$repositCompagnie->find($idCompagnie);
        if ($compagnie === null)
        {
            $this->get('session')->getFlashBag()->add(
                'alert_info',
                'Cette compagnie n\'existe pas');
        }

        $this->get("request_stack")->getCurrentRequest()->getSession()->set('idCompagnie',$idCompagnie);
        //$_SESSION['idCompagnie']=$idCompagnie;

        return $this->render("MainBundle:MesVues:compagnieDetails.html.twig",array(
            'compagnie'=>$compagnie
        ));

    }

    /**
     * @Route("/compagnie/compagnie/modifier/id={idCompagnie}", name="compagnie_modifier")
     */
    public function modifierAction($idCompagnie)
    {
        $em=$this->getDoctrine()->getManager();
        $repositCompganie=$em->getRepository("MainBundle:Compagnie");

        $compagnie=$repositCompganie->find($idCompagnie);

        $form=$this->createForm("MainBundle\Form\CompagnieType",$compagnie);

        $req=$this->get("request_stack");

        if ($req->getCurrentRequest()->getMethod() == 'POST')
        {
            $form->handleRequest($req->getCurrentRequest());
            if ($form->isValid())
            {
                $em->persist($compagnie);
                $em->flush();

                return $this->redirect($this->generateUrl("admin_compagnie"));

            }
        }

        return $this->render('MainBundle:MesVues:modeleNouveau.html.twig',array(
            'form'=>$form->createView(),
            'ent'=>'AUTOBUS'));
    }

    /**
     * @Route("/compagnie/supprimer/id={idCompagnie}", name="compagnie_supprimer")
     */
    public function supprimerAction($idCompagnie)
    {
        $em=$this->getDoctrine()->getManager();

        $repositCompagnie=$em->getRepository("MainBundle:Compagnie");

        $compagnie=$repositCompagnie->find($idCompagnie);

        if ($compagnie !== null)
        {
            $em->remove($compagnie);
            $em->flush();
            return $this->redirect($this->generateUrl("admin_compagnie"));

        }

    }

    /**
     * @Route("/compagnie/liste/",name="compagnie_liste")
     */
    public function listeAction()
    {

        $em=$this->getDoctrine()->getManager();
        $repositCompagnie=$em->getRepository('MainBundle:Compagnie');

        $listeCompagnies=$repositCompagnie->myFind();

        return $this->render('MainBundle:MesVues:listeCompagnie.html.twig',array(
            'listeCompagnies'=>$listeCompagnies));

    }
}
