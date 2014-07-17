<?php

namespace CMS\RepresentanteBundle\Form;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use CMS\ConfiguracoesBundle\Entity\Estado;


class RepresentanteType extends AbstractType
{
    protected $em;


    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('attr' => array('class' => 'form-control')))
            ->add('phone', 'text', array('attr' => array('class' => 'form-control'), 'required' => false))
            ->add('email', 'text', array('attr' => array('class' => 'form-control'), 'required' => false))
            ->add('address', 'text', array('attr' => array('class' => 'form-control')))
            ->add('bairro', 'text', array('attr' => array('class' => 'form-control'), 'required' => false))
            //->add('estado')
            //->add('cidade', 'choice')
            //->add('latitude', 'text', array('attr' => array('class' => 'form-control'), 'required' => false))
            //->add('longitude', 'text', array('attr' => array('class' => 'form-control'), 'required' => false))
            ->add('isActive', 'checkbox');


        // Add listeners
        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
        $builder->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'));
    }


    protected function addElements(FormInterface $form, Estado $estado = null)
    {
        // Remove the submit button, we will place this at the end of the form later

        // Add the province element
        $form->add('estado', 'entity', array(
                'data' => $estado,
                'empty_value' => '-- Escolha --',
                'class' => 'CMSConfiguracoesBundle:Estado')
        );

        // Cities are empty, unless we actually supplied a province
        $cities = array();
        if ($estado) {
            // Fetch the cities from specified province
            $repo = $this->em->getRepository('CMSConfiguracoesBundle:Cidade');
            $cities = $repo->findByEstado($estado, array('nome' => 'asc'));
        }

        // Add the city element
        $form->add('cidade', 'entity', array(
            'empty_value' => '-- Primeiro selecione um estado --',
            'class' => 'CMSConfiguracoesBundle:Cidade',
            'choices' => $cities,
        ));

        // Add submit button again, this time, it's back at the end of the form
        //$form->add($submit);
    }


    function onPreSubmit(FormEvent $event) {
        $form = $event->getForm();
        $data = $event->getData();

        // Note that the data is not yet hydrated into the entity.
        $estado = $this->em->getRepository('CMSConfiguracoesBundle:Estado')->find($data['estado']);
        $this->addElements($form, $estado);

    }


    function onPreSetData(FormEvent $event) {
        $representante = $event->getData();
        $form = $event->getForm();

        // We might have an empty account (when we insert a new account, for instance)
        $estado = $representante->getEstado() ? $representante->getEstado() : null;
        $this->addElements($form, $estado);
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
