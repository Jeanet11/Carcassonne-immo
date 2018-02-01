<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
/**
 * @ORM\Entity
 * @ORM\Table(name="use_user")  
 */
class User extends BaseUser



// /**
//  * User
//  *
//  * @ORM\Table(name="user")
//  * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
//  */
// class User
 {
    /**
     * @var int
     *
     * @ORM\Column(name="use_oid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

