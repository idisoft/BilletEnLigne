<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * OptionAchat
 *
 * @ORM\Table(name="option_achat")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\OptionAchatRepository")
 */
class OptionAchat
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
     * @ORM\Column(name="description", type="string", length=300)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="prixOption", type="integer")
     * @Assert\NotBlank(message="veuillez renseigner le prix de cette option svp !")
     */
    private $prixOption;


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
     * Set description
     *
     * @param string $description
     *
     * @return OptionAchat
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set prixOption
     *
     * @param integer $prixOption
     *
     * @return OptionAchat
     */
    public function setPrixOption($prixOption)
    {
        $this->prixOption = $prixOption;

        return $this;
    }

    /**
     * Get prixOption
     *
     * @return int
     */
    public function getPrixOption()
    {
        return $this->prixOption;
    }
}

