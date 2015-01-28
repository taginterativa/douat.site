<?php

namespace CMS\ConfiguracoesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Regiao
 */
class Regiao
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
    private $estado;

    /**
     * @var integer
     */
    private $cidades;

    public function __construct() {
        $this->cidade = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nome
     *
     * @param string $nome
     * @return Regiao
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
     * Set estado
     *
     * @param integer $estado
     * @return Regiao
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Add cidades
     *
     * @param Cidade $cidade
     * @return Regiao
     */
    public function addCidade(Cidade $cidade)
    {
        $this->cidades[] = $cidade;

        return $this;
    }

    /**
     * Remove cidades
     *
     * @param Cidade $cidade
     */
    public function removeCidade(Cidade $cidade)
    {
        $this->cidades->removeElement($cidade);
    }

    /**
     * Get cidades
     *
     * @return integer 
     */
    public function getCidades()
    {
        return $this->cidades;
    }
}
