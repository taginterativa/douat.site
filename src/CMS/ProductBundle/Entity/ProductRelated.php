<?php

namespace CMS\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductRelated
 */
class ProductRelated
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var boolean
     */
    private $position;

    /**
     * @var \CMS\ProductBundle\Entity\Product
     */
    private $product;

    /**
     * @var \CMS\ProductBundle\Entity\Product
     */
    private $productChild;


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
     * Set position
     *
     * @param boolean $position
     * @return ProductRelated
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return boolean 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set product
     *
     * @param \CMS\ProductBundle\Entity\Product $product
     * @return ProductRelated
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

    /**
     * Set productChild
     *
     * @param \CMS\ProductBundle\Entity\Product $productChild
     * @return ProductRelated
     */
    public function setProductChild(\CMS\ProductBundle\Entity\Product $productChild = null)
    {
        $this->productChild = $productChild;

        return $this;
    }

    /**
     * Get productChild
     *
     * @return \CMS\ProductBundle\Entity\Product 
     */
    public function getProductChild()
    {
        return $this->productChild;
    }
}
