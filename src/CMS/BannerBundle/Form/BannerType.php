<?php

namespace CMS\BannerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BannerType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('title', 'text', array('attr' => array('class' => 'form-control'), 'label' => 'Título'))
            ->add('title', 'textarea', array( 'attr' => array('class' => 'summernote form-control', 'style' => 'width: 100%; height: 100px;'), 'label' => 'Título'))
            ->add('text', 'textarea', array( 'attr' => array('class' => 'summernote form-control', 'style' => 'width: 100%; height: 500px;'), 'label' => 'Texto'))
            ->add('image', 'file', array('required'  => false, 'data_class' => null, 'label' => 'Imagem de fundo'))
            ->add('linkDescription', 'text', array('attr' => array('class' => 'form-control'), 'label' => 'Descrição do link'))
            ->add('linkTarget', 'text', array('attr' => array('class' => 'form-control'), 'label' => 'Endereço do link'))
            ->add('isActive', 'checkbox', array('required' => false, 'label' => 'Ativo'))
            ->add('isDark', 'checkbox', array('required' => false, 'label' => 'Texto escuro'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CMS\BannerBundle\Entity\Banner'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cms_bannerbundle_banner';
    }
}
