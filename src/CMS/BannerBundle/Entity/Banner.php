<?php

namespace CMS\BannerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Banner
 *
 * @ORM\Table(name="banner")
 * @ORM\Entity(repositoryClass="CMS\BannerBundle\Entity\BannerRepository")
 */
class Banner
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="linkDescription", type="string", length=255, nullable=true)
     */
    private $linkDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="linkTarget", type="string", length=255, nullable=true)
     */
    private $linkTarget;

    /**
     * @var bool
     *
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive=false;

    /**
     * @var bool
     *
     * @ORM\Column(name="isDark", type="boolean")
     */
    private $isDark=false;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $position;

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
     * Set title
     *
     * @param string $title
     * @return Banner
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Banner
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Banner
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
     * Set linkDescription
     *
     * @param string $linkDescription
     * @return Banner
     */
    public function setLinkDescription($linkDescription)
    {
        $this->linkDescription = $linkDescription;

        return $this;
    }

    /**
     * Get linkDescription
     *
     * @return string 
     */
    public function getLinkDescription()
    {
        return $this->linkDescription;
    }

    /**
     * Set linkTarget
     *
     * @param string $linkTarget
     * @return Banner
     */
    public function setLinkTarget($linkTarget)
    {
        $this->linkTarget = $linkTarget;

        return $this;
    }

    /**
     * Get linkTarget
     *
     * @return string 
     */
    public function getLinkTarget()
    {
        return $this->linkTarget;
    }

    /**
     * Set isActive
     *
     * @param bool $isActive
     * @return Banner
     */
    public function setIsActive($isActive) {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * Get isActive
     *
     * @return bool 
     */
    public function getIsActive() {
        return $this->isActive;
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


    /**
     * Set position
     *
     * @param bool $position
     * @return Banner
     */
    public function setPosition($position) {
        $this->position = $position;
        return $this;
    }

    /**
     * Get position
     *
     * @return position 
     */
    public function getPosition() {
        return $this->position;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/banner';
    }


    public function upload() {
        if (null === $this->getImage()) {
            return;
        }

        $fileName = md5(uniqid()) . "." . $this->getImage()->guessExtension();

        $this->getImage()->move($this->getUploadRootDir(), $fileName);
        $this->image = $this->getUploadDir() . '/' . $fileName;
    }
}
