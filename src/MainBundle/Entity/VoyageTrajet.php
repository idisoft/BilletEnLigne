<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * VoyageTrajet
 *
 * @ORM\Table(name="voyage_trajet")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\VoyageTrajetRepository")
 */
class VoyageTrajet
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrePlaceInit", type="integer")
     * @Assert\Range(min="1", max="100", invalidMessage="Veuillez saisir un nombre de place raisonnable svp !")
     */
    private $nbrePlaceInit;


    /**
     * @var int
     *
     * @ORM\Column(name="nbrePlaceRestant", type="integer")
     */
    private $nbrePlaceRestant;



    /*
    * ######################## RELATIONSHIP #######################
    */

    /**
     * A VoyageTrajet is beyong a Voyage and a Trajet
     *
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Voyage", inversedBy="voyageTrajets")
     * @Assert\Valid()
     */
    private $voyage;


    /**
     * A VoyageTrajet is beyong a Voyage and a Trajet
     *
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Trajet")
     * @Assert\Valid()
     */
    private $trajet;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getNbrePlaceInit()
    {
        return $this->nbrePlaceInit;
    }

    /**
     * @param int $nbrePlaceInit
     */
    public function setNbrePlaceInit($nbrePlaceInit)
    {
        $this->nbrePlaceInit = $nbrePlaceInit;
    }

    /**
     * @return int
     */
    public function getNbrePlaceRestant()
    {
        return $this->nbrePlaceRestant;
    }

    /**
     * @param int $nbrePlaceRestant
     */
    public function setNbrePlaceRestant($nbrePlaceRestant)
    {
        $this->nbrePlaceRestant = $nbrePlaceRestant;
    }



    /**
     * @return mixed
     */
    public function getVoyage()
    {
        return $this->voyage;
    }


    /**
     * @param mixed $voyage
     */
    public function setVoyage($voyage)
    {
        $this->voyage = $voyage;
    }

    /**
     * @return mixed
     */
    public function getTrajet()
    {
        return $this->trajet;
    }

    /**
     * @param mixed $trajet
     */
    public function setTrajet($trajet)
    {
        $this->trajet = $trajet;
    }

}

