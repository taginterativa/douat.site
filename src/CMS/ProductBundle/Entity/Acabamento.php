<?php

namespace CMS\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acabamento
 */
class Acabamento
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


    public function __toString()
    {
        return $this->getName();
    }
}
