<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * user
 *
 * @ORM\Table(name="my_user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /*
     * ######################## RELATIONSHIP #######################
     */

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Compagnie")
     */
    private $compagnie;

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

