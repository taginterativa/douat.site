<?php

namespace CMS\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Product
 */
class Product
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
    private $code;

    /**
     * @Gedmo\Slug(fields={"name", "code"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;


    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }


    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $composicao;

    /**
     * @var string
     */
    private $gramatura;

    /**
     * @var string
     */
    private $largura;

    /**
     * @var string
     */
    private $rendimento;

    /**
     * @var string
     */
    private $attachment;

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
     * @var \CMS\ProductBundle\Entity\ProductCategory
     */
    private $productCategory;


    /**
     * @var \CMS\ProductBundle\Entity\Acabamento
     */
    private $acabamento;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $productRelated;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $productColor;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->productRelated = new \Doctrine\Common\Collections\ArrayCollection();
        $this->productColor = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Product
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
     * Set code
     *
     * @param string $code
     * @return Product
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
     * Set description
     *
     * @param string $description
     * @return Product
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
     * Set image
     *
     * @param string $image
     * @return Product
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
     * Set composicao
     *
     * @param string $composicao
     * @return Product
     */
    public function setComposicao($composicao)
    {
        $this->composicao = $composicao;

        return $this;
    }

    /**
     * Get composicao
     *
     * @return string 
     */
    public function getComposicao()
    {
        return $this->composicao;
    }

    /**
     * Set gramatura
     *
     * @param string $gramatura
     * @return Product
     */
    public function setGramatura($gramatura)
    {
        $this->gramatura = $gramatura;

        return $this;
    }

    /**
     * Get gramatura
     *
     * @return string 
     */
    public function getGramatura()
    {
        return $this->gramatura;
    }

    /**
     * Set largura
     *
     * @param string $largura
     * @return Product
     */
    public function setLargura($largura)
    {
        $this->largura = $largura;

        return $this;
    }

    /**
     * Get largura
     *
     * @return string 
     */
    public function getLargura()
    {
        return $this->largura;
    }

    /**
     * Set rendimento
     *
     * @param string $rendimento
     * @return Product
     */
    public function setRendimento($rendimento)
    {
        $this->rendimento = $rendimento;

        return $this;
    }

    /**
     * Get rendimento
     *
     * @return string 
     */
    public function getRendimento()
    {
        return $this->rendimento;
    }

    /**
     * Set attachment
     *
     * @param string $attachment
     * @return Product
     */
    public function setAttachment($attachment)
    {
        $this->attachment = $attachment;

        return $this;
    }

    /**
     * Get attachment
     *
     * @return string 
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * Set productCategory
     *
     * @param \CMS\ProductBundle\Entity\ProductCategory $productCategory
     * @return Product
     */
    public function setProductCategory(\CMS\ProductBundle\Entity\ProductCategory $productCategory = null)
    {
        $this->productCategory = $productCategory;

        return $this;
    }

    /**
     * Get productCategory
     *
     * @return \CMS\ProductBundle\Entity\ProductCategory 
     */
    public function getProductCategory()
    {
        return $this->productCategory;
    }



    /**
     * Set Acabamento
     *
     * @param \CMS\ProductBundle\Entity\Acabamento $acabamento
     * @return Product
     */
    public function setAcabamento(\CMS\ProductBundle\Entity\Acabamento $acabamento = null)
    {
        $this->$acabamento = $acabamento;

        return $this;
    }

    /**
     * Get Acabamento
     *
     * @return \CMS\ProductBundle\Entity\Acabamento
     */
    public function getAcabamento()
    {
        return $this->acabamento;
    }
    
    

    /**
     * Add productRelated
     *
     * @param \CMS\ProductBundle\Entity\Product $productRelated
     * @return Product
     */
    public function addProductRelated(\CMS\ProductBundle\Entity\Product $productRelated)
    {
        $this->productRelated[] = $productRelated;

        return $this;
    }

    /**
     * Remove productRelated
     *
     * @param \CMS\ProductBundle\Entity\Product $productRelated
     */
    public function removeProductRelated(\CMS\ProductBundle\Entity\Product $productRelated)
    {
        $this->productRelated->removeElement($productRelated);
    }

    /**
     * Get productRelated
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductRelated()
    {
        return $this->productRelated;
    }

    /**
     * Add productColor
     *
     * @param \CMS\CoresBundle\Entity\Color $productColor
     * @return Product
     */
    public function addProductColor(\CMS\CoresBundle\Entity\Color $productColor)
    {
        $this->productColor[] = $productColor;

        return $this;
    }

    /**
     * Remove productColor
     *
     * @param \CMS\CoresBundle\Entity\Color $productColor
     */
    public function removeProductColor(\CMS\CoresBundle\Entity\Color $productColor)
    {
        $this->productColor->removeElement($productColor);
    }

    /**
     * Get productColor
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductColor()
    {
        return $this->productColor;
    }

    public function __toString()
    {
        return $this->getName();
    }


    public function getAbsolutePath()
    {
        return null === $this->image
            ? null
            : $this->getUploadRootDir().'/'.$this->image;
    }

    public function getWebPath()
    {
        return null === $this->image
            ? null
            : $this->getUploadDir().'/'.$this->image;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/product';
    }


    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getImage()) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $this->getImage()->move(
            $this->getUploadRootDir(),
            $this->getImage()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->image = $this->getUploadDir() . '/' . $this->getImage()->getClientOriginalName();
    }

}
