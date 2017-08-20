<?php

namespace MainBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints as Assert;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home_page")
     */
    public function indexAction()
    {

        $em=$this->getDoctrine()->getManager();
        $form=$this->createForm("MainBundle\Form\RechercheVoyageType");

        $requete=$this->get('request_stack');

        $datas=null;
        $idCompagnie = null;
        $idGareDepart = null;
        $idGareArrivee = null;
        $dateDepart = null;

        if ($requete->getCurrentRequest()->getMethod()=='POST') {
            $form->handleRequest($requete->getCurrentRequest());

            if ($form->isValid()) {

                //On récupère les données entrées dans le formulaire par l'utilisateur
                $datas = $this->get('request_stack')->getCurrentRequest()->request->get('main_bundle_recherche_voyage');

                $idCompagnie = $datas['compagnie'];
                $idGareDepart = $datas['source'];
                $idGareArrivee = $datas['destination'];
                $dateDepart = $datas['dateDepart'];

            }
        }

        // I find the list of programmed voyage
        $repositVoyageTrajet=$em->getRepository('MainBundle:VoyageTrajet');
        $listeVoyageTrajets=$repositVoyageTrajet->findCustomVoyage($idCompagnie,$idGareDepart,$idGareArrivee,$dateDepart);

        return $this->render('MainBundle:MesVues:index.html.twig', array(
            'form' => $form->createView(),
            'listeVoyageTrajets'=>$listeVoyageTrajets));
    }
}
