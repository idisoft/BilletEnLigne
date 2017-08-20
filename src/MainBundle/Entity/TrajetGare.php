<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TrajetGare
 *
 * @ORM\Table(name="trajet_gare")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\TrajetGareRepository")
 */
class TrajetGare
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
     * @ORM\Column(name="Prix", type="integer")
     * @Assert\NotBlank(message="Veuillez fournir le prix de cet trajet svp !")
     */
    private $prix;


    /**
     * @var bool
     *
     * @ORM\Column(name="Ouvert", type="boolean")
     */
    private $ouvert;


    /*
    * ######################## RELATIONSHIP #######################
    */

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Trajet")
     * @Assert\Valid()
     */
    private $trajet;

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Gare")
     * @Assert\Valid()
     */
    private $gare;


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
     * Set prix
     *
     * @param integer $prix
     *
     * @return TrajetGare
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }


    /**
     * Set ouvert
     *
     * @param boolean $ouvert
     *
     * @return TrajetGare
     */
    public function setOuvert($ouvert)
    {
        $this->ouvert = $ouvert;

        return $this;
    }

    /**
     * Get ouvert
     *
     * @return bool
     */
    public function getOuvert()
    {
        return $this->ouvert;
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

    /**
     * @return mixed
     */
    public function getGare()
    {
        return $this->gare;
    }

    /**
     * @param mixed $gare
     */
    public function setGare($gare)
    {
        $this->gare = $gare;
    }

}

