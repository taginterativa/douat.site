<?php

namespace CMS\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Color
 */
class Color
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
    private $hexadecimal;

    /**
     * @var string
     */
    private $code;

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
     * @var \CMS\ProductBundle\Entity\Pantone
     */
    private $pantone;


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
     * @return Color
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
     * Set hexadecimal
     *
     * @param string $hexadecimal
     * @return Color
     */
    public function setHexadecimal($hexadecimal)
    {
        $this->hexadecimal = $hexadecimal;

        return $this;
    }

    /**
     * Get hexadecimal
     *
     * @return string 
     */
    public function getHexadecimal()
    {
        return $this->hexadecimal;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Color
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Color
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
     * @return Color
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
     * @return Color
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

    /**
     * Set pantone
     *
     * @param \CMS\ProductBundle\Entity\Pantone $pantone
     * @return Color
     */
    public function setPantone(\CMS\ProductBundle\Entity\Pantone $pantone = null)
    {
        $this->pantone = $pantone;

        return $this;
    }

    /**
     * Get pantone
     *
     * @return \CMS\ProductBundle\Entity\Pantone 
     */
    public function getPantone()
    {
        return $this->pantone;
    }


    public function __toString()
    {
        return $this->getCode() . ' - ' . $this->getName();
    }
}
