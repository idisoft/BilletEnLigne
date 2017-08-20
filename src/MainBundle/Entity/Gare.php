<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Region
 *
 * @ORM\Table(name="gare")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\GareRepository")
 */
class Gare
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
     * @ORM\Column(name="NomRegion", type="string", length=50)
     * @Assert\NotBlank(message="Veuillez fournir le nom de la Gare svp !")
     */
    private $nomGare;


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
     * @return string
     */
    public function getNomGare()
    {
        return $this->nomGare;
    }

    /**
     * @param string $nomGare
     */
    public function setNomGare($nomGare)
    {
        $this->nomGare = $nomGare;
    }

}

