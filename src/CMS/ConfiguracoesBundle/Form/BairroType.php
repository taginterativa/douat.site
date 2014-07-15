<?php

namespace CMS\ConfiguracoesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BairroType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', 'text', array('attr' => array('class' => 'form-control')))
            ->add('cidade')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CMS\ConfiguracoesBundle\Entity\Bairro'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cms_configuracoesbundle_bairro';
    }
}
