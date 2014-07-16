<?php

namespace CMS\RepresentanteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvents;
use CMS\ConfiguracoesBundle\Entity\Cidade;
use CMS\ConfiguracoesBundle\Entity\Estado;


class RepresentanteType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('attr' => array('class' => 'form-control')))
            ->add('phone', 'text', array('attr' => array('class' => 'form-control')))
            ->add('email', 'text', array('attr' => array('class' => 'form-control')))
            ->add('address', 'text', array('attr' => array('class' => 'form-control')))
            ->add('bairro', 'text', array('attr' => array('class' => 'form-control')))
            ->add('estado')
            ->add('cidade')
            ->add('latitude', 'text', array('attr' => array('class' => 'form-control'), 'required' => false))
            ->add('longitude', 'text', array('attr' => array('class' => 'form-control'), 'required' => false))
            ->add('isActive', 'checkbox');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CMS\RepresentanteBundle\Entity\Representante'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cms_representantebundle_representante';
    }
}
