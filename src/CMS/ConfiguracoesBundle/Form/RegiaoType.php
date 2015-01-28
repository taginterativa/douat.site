<?php

namespace CMS\ConfiguracoesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class RegiaoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function __construct($em) {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $this->em;
        $builder
            ->add('nome', 'text', array('attr' => array('class' => 'form-control')))
            ->add('estado', null)
            ->add('cidades', null)
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CMS\ConfiguracoesBundle\Entity\Regiao'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cms_configuracoesbundle_regiao';
    }
}
