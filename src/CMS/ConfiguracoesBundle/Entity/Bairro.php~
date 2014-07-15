<?php

namespace CMS\ConfiguracoesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bairro
 */
class Bairro
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
     * @return Bairro
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
     * @var \CMS\ConfiguracoesBundle\Entity\Cidade
     */
    private $cidade;


    /**
     * Set cidade
     *
     * @param \CMS\ConfiguracoesBundle\Entity\Cidade $cidade
     * @return Bairro
     */
    public function setCidade(\CMS\ConfiguracoesBundle\Entity\Cidade $cidade = null)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get cidade
     *
     * @return \CMS\ConfiguracoesBundle\Entity\Cidade 
     */
    public function getCidade()
    {
        return $this->cidade;
    }
    /**
     * @var \CMS\ConfiguracoesBundle\Entity\Estado
     */
    private $estado;


    /**
     * Set estado
     *
     * @param \CMS\ConfiguracoesBundle\Entity\Estado $estado
     * @return Bairro
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
}
