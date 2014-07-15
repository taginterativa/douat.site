<?php

namespace CMS\PantoneBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PantoneType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('attr' => array('class' => 'form-control'), 'label' => 'Nome'))
            ->add('hex', 'text', array('attr' => array('class' => 'form-control')))
            ->add('red', 'text', array('attr' => array('class' => 'form-control')))
            ->add('green', 'text', array('attr' => array('class' => 'form-control')))
            ->add('blue', 'text', array('attr' => array('class' => 'form-control')))
            ->add('isActive', 'checkbox', array('attr' => array('class' => 'form-control')))
        ;

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CMS\PantoneBundle\Entity\Pantone'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cms_pantonebundle_pantone';
    }

}
