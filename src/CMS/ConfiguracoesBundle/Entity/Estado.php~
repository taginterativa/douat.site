<?php

namespace CMS\ConfiguracoesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estado
 */
class Estado
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
     * @var string
     */
    private $sigla;


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
     * @return Estado
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
     * Set sigla
     *
     * @param string $sigla
     * @return Estado
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;

        return $this;
    }

    /**
     * Get sigla
     *
     * @return string 
     */
    public function getSigla()
    {
        return $this->sigla;
    }
    /**
     * @var \CMS\ConfiguracoesBundle\Entity\Pais
     */
    private $pais;


    /**
     * Set pais
     *
     * @param \CMS\ConfiguracoesBundle\Entity\Pais $pais
     * @return Estado
     */
    public function setPais(\CMS\ConfiguracoesBundle\Entity\Pais $pais = null)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return \CMS\ConfiguracoesBundle\Entity\Pais 
     */
    public function getPais()
    {
        return $this->pais;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $cidades;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cidades = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add cidades
     *
     * @param \CMS\ConfiguracoesBundle\Entity\Cidade $cidades
     * @return Estado
     */
    public function addCidade(\CMS\ConfiguracoesBundle\Entity\Cidade $cidades)
    {
        $this->cidades[] = $cidades;

        return $this;
    }

    /**
     * Remove cidades
     *
     * @param \CMS\ConfiguracoesBundle\Entity\Cidade $cidades
     */
    public function removeCidade(\CMS\ConfiguracoesBundle\Entity\Cidade $cidades)
    {
        $this->cidades->removeElement($cidades);
    }

    /**
     * Get cidades
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCidades()
    {
        return $this->cidades;
    }

    public function __toString()
    {
        return $this->getNome();
    }
}
