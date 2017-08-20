<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TypeTicket
 *
 * @ORM\Table(name="type_ticket")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\TypeTicketRepository")
 */
class TypeTicket
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
     * @ORM\Column(name="nomType", type="string", length=50)
     * @Assert\NotBlank(message="Veuillez fournir le nom du Type svp !")
     */
    private $nomType;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionType", type="string", length=255,nullable=true)
     */
    private $descriptionType;

    /**
     * @var int
     *
     * @ORM\Column(name="PourcentRed", type="integer")
     * @Assert\Range(min=0, max="100", invalidMessage="Veuillez fournir un pourcentage raisonnable svp !")
     */
    private $pourcentRed;



    /*
    * ######################## RELATIONSHIP #######################
    */

    /**
     * A typeTicket is proposed by a company
     *
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Compagnie")
     * @Assert\Valid()
     */
    private $compagnie;


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
     * Set nomType
     *
     * @param string $nomType
     *
     * @return TypeTicket
     */
    public function setNomType($nomType)
    {
        $this->nomType = $nomType;

        return $this;
    }

    /**
     * Get nomType
     *
     * @return string
     */
    public function getNomType()
    {
        return $this->nomType;
    }

    /**
     * Set descriptionType
     *
     * @param string $descriptionType
     *
     * @return TypeTicket
     */
    public function setDescriptionType($descriptionType)
    {
        $this->descriptionType = $descriptionType;

        return $this;
    }

    /**
     * Get descriptionType
     *
     * @return string
     */
    public function getDescriptionType()
    {
        return $this->descriptionType;
    }

    /**
     * Set pourcentRed
     *
     * @param integer $pourcentRed
     *
     * @return TypeTicket
     */
    public function setPourcentRed($pourcentRed)
    {
        $this->pourcentRed = $pourcentRed;

        return $this;
    }

    /**
     * Get pourcentRed
     *
     * @return int
     */
    public function getPourcentRed()
    {
        return $this->pourcentRed;
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


}

