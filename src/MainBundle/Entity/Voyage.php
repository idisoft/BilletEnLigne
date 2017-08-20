<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Voyage
 *
 * @ORM\Table(name="voyage")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\VoyageRepository")
 */
class Voyage
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
     * @var \DateTime
     *
     * @ORM\Column(name="DateVoyage", type="date")
     * @Assert\Date(message="Veuillez entrer une date correcte svp !")
     */
    private $dateVoyage;

    /**
     * @var string
     *
     * @ORM\Column(name="HeureDepart", type="time")
     * @Assert\Time(message="Veuillez saisir une heure correcte svp !")
     */
    private $heureDepart;


    /**
     * @var string
     *
     * @ORM\Column(name="StatusVoyage", type="string", length=10)
     */
    private $statusVoyage;


    /*
    * ######################## RELATIONSHIP #######################
    */

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\AutoBus")
     * @Assert\Valid()
     */
    private $autoBus;


    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Trajet")
     * @Assert\Valid()
     */
    private $trajet;

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Promotion")
     * @Assert\Valid()
     */
    private $promotion;


    /**
     * @ORM\OneToMany(targetEntity="MainBundle\Entity\VoyageTrajet", mappedBy="voyage", cascade={"all"})
     */
    private $voyageTrajets;


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
     * @return \DateTime
     */
    public function getDateVoyage()
    {
        return $this->dateVoyage;
    }

    /**
     * @param \DateTime $dateVoyage
     */
    public function setDateVoyage($dateVoyage)
    {
        $this->dateVoyage = $dateVoyage;
    }

    /**
     * @return string
     */
    public function getHeureDepart()
    {
        return $this->heureDepart;
    }

    /**
     * @param string $heureDepart
     */
    public function setHeureDepart($heureDepart)
    {
        $this->heureDepart = $heureDepart;
    }

    /**
     * @return string
     */
    public function getStatusVoyage()
    {
        return $this->statusVoyage;
    }

    /**
     * @param string $statusVoyage
     */
    public function setStatusVoyage($statusVoyage)
    {
        $this->statusVoyage = $statusVoyage;
    }

    /**
     * @return mixed
     */
    public function getAutoBus()
    {
        return $this->autoBus;
    }

    /**
     * @param mixed $autoBus
     */
    public function setAutoBus($autoBus)
    {
        $this->autoBus = $autoBus;
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
    public function getPromotion()
    {
        return $this->promotion;
    }

    /**
     * @param mixed $promotion
     */
    public function setPromotion($promotion)
    {
        $this->promotion = $promotion;
    }

    /**
     * @return mixed
     */
    public function getVoyageTrajets()
    {
        return $this->voyageTrajets;
    }

    /**
     * @param mixed $voyageTrajets
     */
    public function setVoyageTrajets($voyageTrajets)
    {
        $this->voyageTrajets = $voyageTrajets;
    }
}

