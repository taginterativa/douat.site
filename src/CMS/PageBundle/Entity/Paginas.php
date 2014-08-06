<?php

namespace CMS\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paginas
 */
class Paginas
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
    private $imagem;

    /**
     * @var boolean
     */
    private $isActive;

    /**
     * @var string
     */
    private $descricao;

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
    private $isDark;

    /**
     * Set id
     *
     * @param integer $id
     * @return Paginas
     */
    public function setId($id)
    {
        $this->nome = $nome;
        return $this;
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
     * @return Paginas
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
     * Set imagem
     *
     * @param string $imagem
     * @return Paginas
     */
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;

        return $this;
    }

    /**
     * Get imagem
     *
     * @return string 
     */
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Paginas
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
     * Set descricao
     *
     * @param string $descricao
     * @return Paginas
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string 
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Paginas
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
     * @return Paginas
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
     * Set isDark
     *
     * @param bool $isDark
     * @return Banner
     */
    public function setIsDark($isDark) {
        $this->isDark = $isDark;
        return $this;
    }

    /**
     * Get isDark
     *
     * @return bool 
     */
    public function getIsDark() {
        return $this->isDark;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/background';
    }


    public function upload() {
        if (null === $this->getImagem()) {
            return;
        }

        $extension = $this->getImagem()->guessExtension();

        $this->getImagem()->move($this->getUploadRootDir(), $this->getId() . "." . $extension);
        $this->imagem = $this->getUploadDir() . '/' . $this->getId() . "." . $extension;
    }
}
