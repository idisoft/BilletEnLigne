<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber as AssertPhoneNumbe;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\TicketRepository")
 */
class Ticket
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
     * @var string
     *
     * @ORM\Column(name="Code", type="string", length=14, unique=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="NomClient", type="string", length=100)
     * @Assert\NotBlank(message="Veuillez fournir le nom du client svp !")
     */
    private $nomClient;

    /**
     * @var string
     *
     * @ORM\Column(name="PrenomClient", type="string", length=25)
     * @Assert\NotBlank(message="Veuillez fournir le prenom du client svp !")
     */
    private $prenomClient;

    /**
     * @var string
     *
     * @ORM\Column(name="TelClient", type="phone_number")
     * @AssertPhoneNumbe(message="Veuillez entrer un numéro de téléphone correcte svp !")
     */
    private $telClient;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateAchat", type="datetime")
     * @Assert\Date(message="Veuillez entrer une date correcte svp !")
     */
    private $dateAchat;

    /**
     * @var int
     *
     * @ORM\Column(name="PrixTicket", type="integer")
     * @Assert\NotBlank(message="Veuillez founir le prix du Ticket svp !")
     */
    private $prixTicket;


    /*
     * ######################## RELATIONSHIP #######################
     */

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\VoyageTrajet")
     * @Assert\Valid()
     */
    private $voyageTrajet;


    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @Assert\Valid()
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\TypeTicket")
     * @Assert\Valid()
     */
    private $typeTicket;


    /**
     * @ORM\ManyToMany(targetEntity="MainBundle\Entity\OptionAchat")
     */
    private $optionsAchat;





    public function __construct()
    {
        $this->dateAchat= new \DateTime();
    }

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
     * Set code
     *
     * @param string $code
     *
     * @return Ticket
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set nomClient
     *
     * @param string $nomClient
     *
     * @return Ticket
     */
    public function setNomClient($nomClient)
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    /**
     * Get nomClient
     *
     * @return string
     */
    public function getNomClient()
    {
        return $this->nomClient;
    }

    /**
     * Set prenomClient
     *
     * @param string $prenomClient
     *
     * @return Ticket
     */
    public function setPrenomClient($prenomClient)
    {
        $this->prenomClient = $prenomClient;

        return $this;
    }

    /**
     * Get prenomClient
     *
     * @return string
     */
    public function getPrenomClient()
    {
        return $this->prenomClient;
    }

    /**
     * @return string
     */
    public function getTelClient()
    {
        return $this->telClient;
    }

    /**
     * @param string $telClient
     */
    public function setTelClient($telClient)
    {
        $this->telClient = $telClient;
    }


    /**
     * Set dateAchat
     *
     * @param \DateTime $dateAchat
     *
     * @return Ticket
     */
    public function setDateAchat($dateAchat)
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    /**
     * Get dateAchat
     *
     * @return \DateTime
     */
    public function getDateAchat()
    {
        return $this->dateAchat;
    }

    /**
     * Set prixTicket
     *
     * @param integer $prixTicket
     *
     * @return Ticket
     */
    public function setPrixTicket($prixTicket)
    {
        $this->prixTicket = $prixTicket;

        return $this;
    }

    /**
     * Get prixTicket
     *
     * @return int
     */
    public function getPrixTicket()
    {
        return $this->prixTicket;
    }

    /**
     * @return mixed
     */
    public function getVoyageTrajet()
    {
        return $this->voyageTrajet;
    }

    /**
     * @param mixed $voyageTrajet
     */
    public function setVoyageTrajet($voyageTrajet)
    {
        $this->voyageTrajet = $voyageTrajet;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getTypeTicket()
    {
        return $this->typeTicket;
    }


    /**
     * @param mixed $typeTicket
     */
    public function setTypeTicket($typeTicket)
    {
        $this->typeTicket = $typeTicket;
    }


    /**
     * @return mixed
     */
    public function getOptionsAchat()
    {
        return $this->optionsAchat;
    }

    /**
     * @param mixed $optionsAchat
     */
    public function setOptionsAchat($optionsAchat)
    {
        $this->optionsAchat = $optionsAchat;
    }

}

