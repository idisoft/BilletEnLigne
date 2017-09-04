<?php
/**
 * Created by PhpStorm.
 * User: DRISSA
 * Date: 09/03/2017
 * Time: 17:49
 */

namespace MainBundle\CustomServices;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class MyCustomServices
{
    private $tokenStorage;
    protected $em;
    protected $requestStack;

    public function __construct(RequestStack $reqStack, TokenStorage $tokenS, EntityManager $emanager)
    {
        $this->requestStack=$reqStack;
        $this->tokenStorage=$tokenS;
        $this->em=$emanager;

    }

    public function initEnv()
    {
        $this->requestStack->getCurrentRequest()->getSession()->set('idCompagnie',$this->getCurentCompagnieId());
        $this->requestStack->getCurrentRequest()->getSession()->set('idUser',$this->getCurentUser()->getId());

        return;

    }

    public function getCurentUser()
    {
        // On récupère le token
        $token = $this->tokenStorage->getToken();

        // Si la requête courante n'est pas derrière un pare-feu, $token est null. Sinon, on récupère l'utilisateur
        $user = $token->getUser();

        if (is_null($user)) return null;

        return $user;
    }


    public function getCurentCompagnieId()
    {
        $user=$this->getCurentUser();

        if (is_null($user))
        {
            return null;
        }

        $compagnie=$user->getCompagnie();

        if (is_null($compagnie))
        {
            return null;
        }

        return $compagnie->getId();

    }

    public function verifyCompany ($idCompagnie)
    {
        $em=$this->getDoctrine()->getManager();
        $repositCompagnie=$em->getRepository('MainBundle:Compagnie');

        $compagnie=$repositCompagnie->find($idCompagnie);
        if ($compagnie === null)
        {
            $this->get('session')->getFlashBag()->add('alert_info','Cette compagnie n\'existe pas');
            return null;
        }

        return $idCompagnie;
    }

    public function getStats()
    {

        $idCompagnie=$this->requestStack->getCurrentRequest()->getSession()->get('idCompagnie');
        $idUser=$this->requestStack->getCurrentRequest()->getSession()->get('idUser');

        $repositVoyage=$this->em->getRepository('MainBundle:Voyage');
        $repositCompagnie=$this->em->getRepository('MainBundle:Compagnie');
        $repositTicket=$this->em->getRepository('MainBundle:Ticket');
        $repositTrajet=$this->em->getRepository('MainBundle:Trajet');

        $stats['nbreCompagnie']=$repositCompagnie->getNbreCompagnie();
        $stats['nbreTrajetByCurrentCompagnie']=$repositTrajet->getNbreTrajetByCurrentCompagnie($idCompagnie);
        $stats['nbreVoyageOuvert']=$repositVoyage->getNbreVoyageByCompagnieAndStatus($idCompagnie,'open');
        $stats['nbreTicket']=$repositTicket->getNbreTicketVenduByCurrentUser($idUser);

        return $stats;

    }


}
