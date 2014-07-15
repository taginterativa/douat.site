<?php

namespace CMS\ConfiguracoesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cidade
 */
class Cidade
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
     * @var integer
     */
    private $ddd;

    /**
     * @var boolean
     */
    private $capital;


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
     * @return Cidade
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
     * Set ddd
     *
     * @param integer $ddd
     * @return Cidade
     */
    public function setDdd($ddd)
    {
        $this->ddd = $ddd;

        return $this;
    }

    /**
     * Get ddd
     *
     * @return integer 
     */
    public function getDdd()
    {
        return $this->ddd;
    }

    /**
     * Set capital
     *
     * @param boolean $capital
     * @return Cidade
     */
    public function setCapital($capital)
    {
        $this->capital = $capital;

        return $this;
    }

    /**
     * Get capital
     *
     * @return boolean 
     */
    public function getCapital()
    {
        return $this->capital;
    }
    /**
     * @var \CMS\ConfiguracoesBundle\Entity\Estado
     */
    private $estado;


    /**
     * Set estado
     *
     * @param \CMS\ConfiguracoesBundle\Entity\Estado $estado
     * @return Cidade
     */
    public function setEstado(\CMS\ConfiguracoesBundle\Entity\Estado $estado = null)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return \CMS\ConfiguracoesBundle\Entity\Estado 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    public function __toString()
    {
        return $this->getNome();
    }
    /**
     * @var string
     */
    private $image;


    /**
     * Set image
     *
     * @param string $image
     * @return Cidade
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
     * @var string
     */
    private $slug;


    /**
     * Set slug
     *
     * @param string $slug
     * @return Cidade
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
}
