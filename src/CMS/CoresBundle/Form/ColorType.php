<?php

namespace CMS\CoresBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ColorType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('attr' => array('class' => 'form-control')))
            ->add('image', 'file', array('required'  => false, 'data_class' => null, 'required' => false ))
            ->add('pantone', null, array('required' => false))
            ->add('hexadecimal', 'text', array('attr' => array('class' => 'form-control'), 'required' => false))
            ->add('code', 'text', array('attr' => array('class' => 'form-control')))
            ->add('isActive', 'checkbox')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CMS\CoresBundle\Entity\Color'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cms_coresbundle_color';
    }
}
