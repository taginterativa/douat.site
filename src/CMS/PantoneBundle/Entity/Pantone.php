<?php

namespace CMS\PantoneBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pantone
 */
class Pantone
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $hex;

    /**
     * @var string
     */
    private $red;

    /**
     * @var string
     */
    private $green;

    /**
     * @var string
     */
    private $blue;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var boolean
     */
    private $isActive;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Pantone
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set hex
     *
     * @param string $hex
     * @return Pantone
     */
    public function setHex($hex)
    {
        $this->hex = $hex;

        return $this;
    }

    /**
     * Get hex
     *
     * @return string 
     */
    public function getHex()
    {
        return $this->hex;
    }

    /**
     * Set red
     *
     * @param string $red
     * @return Pantone
     */
    public function setRed($red)
    {
        $this->red = $red;

        return $this;
    }

    /**
     * Get red
     *
     * @return string 
     */
    public function getRed()
    {
        return $this->red;
    }

    /**
     * Set green
     *
     * @param string $green
     * @return Pantone
     */
    public function setGreen($green)
    {
        $this->green = $green;

        return $this;
    }

    /**
     * Get green
     *
     * @return string 
     */
    public function getGreen()
    {
        return $this->green;
    }

    /**
     * Set blue
     *
     * @param string $blue
     * @return Pantone
     */
    public function setBlue($blue)
    {
        $this->blue = $blue;

        return $this;
    }

    /**
     * Get blue
     *
     * @return string 
     */
    public function getBlue()
    {
        return $this->blue;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Pantone
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Pantone
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Pantone
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }


    public function __toString()
    {
        return $this->name;
    }
}
