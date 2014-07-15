<?php

namespace CMS\ConfiguracoesBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Pais
 */
class Pais
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nome;


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
     * Set nome
     *
     * @param string $nome
     * @return Pais
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $estados;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->estados = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add estados
     *
     * @param \CMS\ConfiguracoesBundle\Entity\Estado $estados
     * @return Pais
     */
    public function addEstado(\CMS\ConfiguracoesBundle\Entity\Estado $estados)
    {
        $this->estados[] = $estados;

        return $this;
    }

    /**
     * Remove estados
     *
     * @param \CMS\ConfiguracoesBundle\Entity\Estado $estados
     */
    public function removeEstado(\CMS\ConfiguracoesBundle\Entity\Estado $estados)
    {
        $this->estados->removeElement($estados);
    }

    /**
     * Get estados
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstados()
    {
        return $this->estados;
    }

    public function __toString()
    {
        return $this->getNome();
    }
    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"nome"}, updatable=false)
     *
     */
    private $slug;


    /**
     * Set slug
     *
     * @param string $slug
     * @return Pais
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $updated;


    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Pais
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Pais
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}
