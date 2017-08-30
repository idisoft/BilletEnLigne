<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Ticket;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TicketController extends Controller
{

    /**
     * @Route("/ticket/", name="admin_tickets")
     */
    public function adminTicketsAction()
    {
        //j'initialise mon env idCompagnie, idUser pour adapter l'env à celui qui est connecté
        $this->get('main_mycustomservices')->initEnv();


        $em=$this->getDoctrine()->getManager();
        $form=$this->createForm("MainBundle\Form\RechercheVoyageType");

        $requete=$this->get('request_stack');

        $datas=null;
        if ($requete->getCurrentRequest()->getMethod()=='POST') {
            $form->handleRequest($requete->getCurrentRequest());


            if ($form->isValid()) {

                //On récupère les données entrées dans le formulaire par l'utilisateur
                $datas = $this->get('request_stack')->getCurrentRequest()->request->get('main_bundle_recherche_voyage');

                $idCompagnie = $datas['compagnie'];
                $idGareDepart = $datas['source'];
                $idGareArrivee = $datas['destination'];
                $dateDepart = $datas['dateDepart'];

                // I find the list of programmed voyage

                $repositVoyageTrajet=$em->getRepository('MainBundle:VoyageTrajet');
                $listeVoyageTrajets=$repositVoyageTrajet->findCustomVoyage($idCompagnie,$idGareDepart,$idGareArrivee,$dateDepart);

                return $this->render('MainBundle:MesVues:adminTickets.html.twig', array(
                    'form' => $form->createView(),
                    'listeVoyageTrajets'=>$listeVoyageTrajets));
            }
        }

        return $this->render('MainBundle:MesVues:adminTickets.html.twig', array(
            'form' => $form->createView()));
    }


    /**
     * @Route("/ticket/nouveau/{idVoyageTrajet}", name="ticket_nouveau")
     */
    public function nouveauAction($idVoyageTrajet)
    {
        $em=$this->getDoctrine()->getManager();
        $repositVoyageTrajet=$em->getRepository("MainBundle:VoyageTrajet");
        $voyageTrajet=$repositVoyageTrajet->find($idVoyageTrajet);

        $nomComp=$voyageTrajet->getTrajet()->getCompagnie()->getNomComp();
        $code = substr($nomComp,0,3) . substr(uniqid(true), -5);
        $prix=$voyageTrajet->getTrajet()->getPrixTrajet();
        $user=$this->get('main_mycustomservices')->getCurentUser();

        $ticket=new Ticket();
        $ticket->setVoyageTrajet($voyageTrajet);
        $ticket->setCode($code);
        $ticket->setPrixTicket($prix);
        $ticket->setUser($user);

        $form=$this->createForm("MainBundle\Form\TicketType",$ticket);

        $req=$this->get("request_stack");

        if ($req->getCurrentRequest()->getMethod() == 'POST')
        {
            $form->handleRequest($req->getCurrentRequest());
            if ($form->isValid())
            {
                $voyageTrajet=$ticket->getVoyageTrajet();
                $voyageTrajet->setNbrePlaceRestant($voyageTrajet->getNbrePlaceRestant() - 1);
                $em->persist($ticket,$voyageTrajet);

                /*return $this->render("MainBundle:MesVues:payement.html.twig",array(
                    'code'=>$code,
                    'prixTicket'=>$prix
                ));*/

                $em->flush();

                $this->addFlash('alert_info','TICKET PRIT AVEC SUCCES, CI-DESSOUS LES DETAILS');

                return $this->render("MainBundle:MesVues:remerciement.html.twig",array(
                    'ticket'=>$ticket
                ));

            }
        }

        return $this->render('MainBundle:MesVues:modeleNouveau.html.twig',array(
            'form'=>$form->createView(),
            'ent'=>'TICKET'));
    }


    /**
     * @Route("/ticket/validation", name="ticket_validation")
     */
    public function ticketValidationAction($ticket)
    {
        $em=$this->getDoctrine()->getManager();
        $em->flush();

        $this->addFlash('alert_info','TICKET PRIT AVEC SUCCES, CI-DESSOUS LES DETAILS');

        return $this->render("MainBundle:MesVues:remerciement.html.twig",array(
            'ticket'=>$ticket));
    }

    /**
     * @Route("/voyage/ticket/annulation", name="ticket_annulation")
     */
    public function ticketAnnulationAction()
    {
        return $this->render("MainBundle:MesVues:annulation.html.twig");
    }


    public function findByCurrentUserAction()
    {
        $ticketRep=$this->getDoctrine()->getManager()->getRepository('MainBundle:Ticket');

        $idUser=$this->get("request_stack")->getCurrentRequest()->getSession()->get('idUser');

        $listeTickets=$ticketRep->findByCurrentUser($idUser);

        return $this->render("MainBundle:MesVues:listeTicket.html.twig",array(
            'listeTickets'=>$listeTickets
        ));
    }
}
