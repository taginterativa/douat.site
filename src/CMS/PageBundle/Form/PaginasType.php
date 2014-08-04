<?php

namespace CMS\PageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PaginasType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', 'text', array('attr' => array('class' => 'form-control')))
            ->add('imagem', 'file', array('required'  => false, 'data_class' => null, 'label' => 'Imagem de Fundo'))
            ->add('descricao', 'textarea', array( 'attr' => array('class' => 'wysihtml5 form-control', 'style' => 'width: 100%; height: 500px;')) )
            ->add('isActive', 'checkbox', array('attr' => array('required' => false), 'label' => 'Ativo'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CMS\PageBundle\Entity\Paginas'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cms_pagebundle_paginas';
    }
}
