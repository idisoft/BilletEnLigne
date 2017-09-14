<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AutoBus
 *
 * @ORM\Table(name="auto_bus")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\AutoBusRepository")
 */
class AutoBus
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
     * @ORM\Column(name="Code", type="string", length=25, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(max="15", maxMessage="Nom de code trop long !!")
     */
    private $code;

    /**
     * @var int
     *
     * @ORM\Column(name="NbrePlace", type="integer", nullable=true)
     * @Assert\Range(min=1, max="70", maxMessage="Nombre de places trop grand", minMessage="Nombre de places trop petit")
     */
    private $nbrePlace;

    /*
     * ######################## RELATIONSHIP #######################
     */

    /**
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
     * Set code
     *
     * @param string $code
     *
     * @return AutoBus
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
     * Set nbrePlace
     *
     * @param integer $nbrePlace
     *
     * @return AutoBus
     */
    public function setNbrePlace($nbrePlace)
    {
        $this->nbrePlace = $nbrePlace;

        return $this;
    }

    /**
     * Get nbrePlace
     *
     * @return int
     */
    public function getNbrePlace()
    {
        return $this->nbrePlace;
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

