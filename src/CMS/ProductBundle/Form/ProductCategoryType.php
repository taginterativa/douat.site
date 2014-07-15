<?php

namespace CMS\ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductCategoryType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('attr' => array('class' => 'form-control')))
            ->add('description', 'textarea', array( 'attr' => array('class' => 'wysihtml5 form-control', 'style' => 'width: 100%; height: 100px;')) )
            ->add('image', 'file', array('required'  => false, 'data_class' => null ))
            ->add('isActive', 'checkbox')
            ->add('parent')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CMS\ProductBundle\Entity\ProductCategory'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cms_productbundle_productcategory';
    }
}
