<?php

namespace CMS\ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use CMS\ProductBundle\Entity\Product;


class ProductType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('attr' => array('class' => 'form-control')))
            ->add('code', 'text', array('attr' => array('class' => 'form-control')))
            ->add('description', 'textarea', array( 'attr' => array('class' => 'wysihtml5 form-control', 'style' => 'width: 100%; height: 100px;')) )
            ->add('image', 'file', array('required'  => false, 'data_class' => null ))
            ->add('composicao', 'text', array('attr' => array('class' => 'form-control')))
            ->add('gramatura', 'text', array('attr' => array('class' => 'form-control')))
            ->add('largura', 'text', array('attr' => array('class' => 'form-control')))
            ->add('rendimento', 'text', array('attr' => array('class' => 'form-control')))
            //->add('attachment', 'text', array('attr' => array('class' => 'form-control')))
            ->add('isActive', 'checkbox')
            ->add('productCategory')
            ->add('productRelated', null, array('required' => false))
            ->add('productColor')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CMS\ProductBundle\Entity\Product'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cms_productbundle_product';
    }
}
