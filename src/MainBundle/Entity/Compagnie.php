<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber as AssertPhoneNumber;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Compagnie
 *
 * @ORM\Table(name="compagnie")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\CompagnieRepository")
 */
class Compagnie
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
     * @ORM\Column(name="NomComp", type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(max="30", maxMessage="Nom de compagnie  trop long !!")
     */
    private $nomComp;

    /**
     * @var string
     *
     * @ORM\Column(name="AdresseComp", type="string", length=255)
     * @Assert\Length(max="100", maxMessage="Adresse trop longue !!")
     */
    private $adresseComp;

    /**
     * @var string
     *
     * @ORM\Column(name="TelComp", type="phone_number", nullable=true)
     * @AssertPhoneNumber(defaultRegion="ML", message="Ceci n'est pas un numéro valide")
    )
     */
    private $telComp;


    /*
    * ######################## RELATIONSHIP #######################
    */

    /**
     * @ORM\OneToMany(targetEntity="MainBundle\Entity\AutoBus", mappedBy="compagnie", cascade={"all"})
     */
    private $autoBus;



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
     * Set nomComp
     *
     * @param string $nomComp
     *
     * @return Compagnie
     */
    public function setNomComp($nomComp)
    {
        $this->nomComp = $nomComp;

        return $this;
    }

    /**
     * Get nomComp
     *
     * @return string
     */
    public function getNomComp()
    {
        return $this->nomComp;
    }

    /**
     * Set adresseComp
     *
     * @param string $adresseComp
     *
     * @return Compagnie
     */
    public function setAdresseComp($adresseComp)
    {
        $this->adresseComp = $adresseComp;

        return $this;
    }

    /**
     * Get adresseComp
     *
     * @return string
     */
    public function getAdresseComp()
    {
        return $this->adresseComp;
    }

    /**
     * @return string
     */
    public function getTelComp()
    {
        return $this->telComp;
    }

    /**
     * @param string $telComp
     */
    public function setTelComp($telComp)
    {
        $this->telComp = $telComp;
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

}

