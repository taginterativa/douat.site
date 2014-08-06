<?php

namespace CMS\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductColor
 */
class ProductColor
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $image;

    /**
     * @var \CMS\CoresBundle\Entity\Color
     */
    private $color;

    /**
     * @var \CMS\ProductBundle\Entity\Product
     */
    private $product;


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
     * Set image
     *
     * @param string $image
     * @return ProductColor
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set color
     *
     * @param \CMS\CoresBundle\Entity\Color $color
     * @return ProductColor
     */
    public function setColor(\CMS\CoresBundle\Entity\Color $color = null)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return \CMS\CoresBundle\Entity\Color 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set product
     *
     * @param \CMS\ProductBundle\Entity\Product $product
     * @return ProductColor
     */
    public function setProduct(\CMS\ProductBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \CMS\ProductBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
}
