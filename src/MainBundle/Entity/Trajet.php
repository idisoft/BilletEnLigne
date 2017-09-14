<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trajet
 *
 * @ORM\Table(name="trajet")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\TrajetRepository")
 */
class Trajet
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
     * @ORM\Column(name="Distance", type="integer", nullable=true)
     * @Assert\Range(min=50, max="3000", maxMessage="Veuillez fournir une distance raisonnable svp !")
     */
    private $distance;

    /**
     * @var int
     *
     * @ORM\Column(name="PrixTrajet", type="integer")
     * @Assert\Length(max="5", maxMessage="Le prix semble incorrect !!")
     */
    private $prixTrajet;

    /*
    * ######################## RELATIONSHIP #######################
    */

    /**
     * A trajet is proposed by a company
     *
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Compagnie")
     * @Assert\Valid()
     */
    private $compagnie;

    /**
     * A trajet has a source
     *
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Gare")
     * @Assert\Valid()
     */
    private $source;

    /**
     * A trajet has a destination
     *
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Gare")
     * @Assert\Valid()
     */
    private $destination;

    /**
     * A trajet has a parent. This mean a parent trajet has one or many sub-trajet
     *
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Trajet")
     * @Assert\Valid()
     */
    private $trajetParent;



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
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param int $distance
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
    }

    /**
     * @return int
     */
    public function getPrixTrajet()
    {
        return $this->prixTrajet;
    }

    /**
     * @param int $prixTrajet
     */
    public function setPrixTrajet($prixTrajet)
    {
        $this->prixTrajet = $prixTrajet;
    }

    /**
     * @return mixed
     */
    public function getCompagnie()
    {
        return $this->compagnie;
    }

    /**
     * @param mixed $compagnie
     */
    public function setCompagnie($compagnie)
    {
        $this->compagnie = $compagnie;
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param mixed $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param mixed $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    /**
     * @return mixed
     */
    public function getTrajetParent()
    {
        return $this->trajetParent;
    }

    /**
     * @param mixed $trajetParent
     */
    public function setTrajetParent($trajetParent)
    {
        $this->trajetParent = $trajetParent;
    }


    public function getTrajet()
    {
        return $this->getSource()->getNomGare() . ' ' . $this->getDestination()->getNomGare();
    }
}

