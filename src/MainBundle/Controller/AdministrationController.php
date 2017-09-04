<?php

namespace MainBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdministrationController extends Controller
{

    /**
     * @Route("/admin_home/", name="admin_home_page")
     * @Security("has_role('ROLE_SELLER')")
     *
     */
    public function indexAction()
    {

        //j'initialise mon env idCompagnie, idUser pour adapter l'env à celui qui est connecté
        $this->get('main_mycustomservices')->initEnv();

        $stats=$this->get('main_mycustomservices')->getStats();

        return $this->render('MainBundle:MesVues:adminIndex.html.twig', array('stats'=>$stats));
    }
}
