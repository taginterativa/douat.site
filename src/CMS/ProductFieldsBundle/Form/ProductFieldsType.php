<?php

namespace CMS\ProductFieldsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductFieldsType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('attr' => array('class' => 'form-control'), 'label' => 'Nome'))
            ->add('padrao', 'text', array('attr' => array('class' => 'form-control'), 'label' => 'Valor padrão', 'required' => false))
            ->add('isActive', 'checkbox')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CMS\ProductFieldsBundle\Entity\ProductFields'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cms_productfieldsbundle_productfields';
    }
}
