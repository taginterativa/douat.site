<?php

namespace CMS\ConfiguracoesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Endereco
 */
class Endereco
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
    private $numero;

    /**
     * @var string
     */
    private $cep;


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
     * @return Endereco
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
     * Set numero
     *
     * @param string $numero
     * @return Endereco
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set cep
     *
     * @param string $cep
     * @return Endereco
     */
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get cep
     *
     * @return string 
     */
    public function getCep()
    {
        return $this->cep;
    }
    /**
     * @var \CMS\ConfiguracoesBundle\Entity\Bairro
     */
    private $bairro;


    /**
     * Set bairro
     *
     * @param \CMS\ConfiguracoesBundle\Entity\Bairro $bairro
     * @return Endereco
     */
    public function setBairro(\CMS\ConfiguracoesBundle\Entity\Bairro $bairro = null)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get bairro
     *
     * @return \CMS\ConfiguracoesBundle\Entity\Bairro 
     */
    public function getBairro()
    {
        return $this->bairro;
    }
    /**
     * @var \CMS\ConfiguracoesBundle\Entity\Estado
     */
    private $estado;

    /**
     * @var \CMS\ConfiguracoesBundle\Entity\Cidade
     */
    private $cidade;


    /**
     * Set estado
     *
     * @param \CMS\ConfiguracoesBundle\Entity\Estado $estado
     * @return Endereco
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

    /**
     * Set cidade
     *
     * @param \CMS\ConfiguracoesBundle\Entity\Cidade $cidade
     * @return Endereco
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
}
