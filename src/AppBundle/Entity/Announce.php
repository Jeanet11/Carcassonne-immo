<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;


/**
 * Announce
 * @Vich\Uploadable
 * @ORM\Table(name="ann_announce")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AnnounceRepository")
 */
class Announce
{
    /**
     * @var int
     *
     * @ORM\Column(name="ann_oid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ann_title", type="string", length=255)
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="ann_numberOfRooms", type="integer")
     */
    private $numberOfRooms;

    /**
     * @var float
     *
     * @ORM\Column(name="ann_price", type="float")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="ann_picture", type="string", length=255)
     */
    private $picture;


    /**
 * @Vich\UploadableField(mapping="photo", fileNameProperty="picture")
 * 
 * @var File
 */
private $pictureFile;
/**
 * @ORM\Column(type="datetime", nullable= true)
 *
 * @var \DateTime
*/
private $updatedAt;



    /**
     * @var string
     *
     * @ORM\Column(name="ann_description", type="text")
     */
    private $description;

     /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="cat_oid", referencedColumnName="cat_oid")
     */
    private $category;

     /**
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(name="cli_oid", referencedColumnName="cli_oid")
     */
    private $client;

     /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="usr_oid", referencedColumnName="usr_oid")
     */
    private $user;


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
     * Set title
     *
     * @param string $title
     *
     * @return Announce
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set numberOfRooms
     *
     * @param integer $numberOfRooms
     *
     * @return Announce
     */
    public function setNumberOfRooms($numberOfRooms)
    {
        $this->numberOfRooms = $numberOfRooms;

        return $this;
    }

    /**
     * Get numberOfRooms
     *
     * @return int
     */
    public function getNumberOfRooms()
    {
        return $this->numberOfRooms;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Announce
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return Announce
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Announce
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
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Announce
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     *
     * @return Announce
     */
    public function setClient(\AppBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Announce
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
 * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $devis
 *
 * @return Picture
*/
public function setPictureFile(File $picture = null)
{
    $this->pictureFile = $picture;

    if ($picture) 
        $this->updatedAt = new \DateTimeImmutable();
    
    return $this;
}
/**
 * @return File|null
 */
public function getPictureFile()
{
    return $this->pictureFile;
}

}
