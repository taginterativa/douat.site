<?php

namespace CMS\ContatoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContatoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', 'text', array('attr' => array('class' => 'form-control')))
            ->add('email', 'text', array('attr' => array('class' => 'form-control')))
            ->add('descricao', 'text', array('attr' => array('class' => 'form-control')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CMS\ContatoBundle\Entity\Contato'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cms_contatobundle_contato';
    }
}
