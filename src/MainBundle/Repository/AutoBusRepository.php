<?php

namespace MainBundle\Repository;

/**
 * AutoBusRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AutoBusRepository extends \Doctrine\ORM\EntityRepository
{

    public function findByCurrentCompagnie()             // utiliser dans Formulaire Parcours
    {
        // Pour le Formulaire Parcours

        $qb=$this->createQueryBuilder('auto_bus');

        $idCompagnie=$_SESSION['idCompagnie'];

        if(! is_null($idCompagnie))
        {
            $qb->where('auto_bus.compagnie= :idCompagnie')
                ->setParameter('idCompagnie',$idCompagnie);
        }

        return $qb;
    }
}
