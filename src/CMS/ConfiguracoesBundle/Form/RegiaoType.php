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
        #$estado = $em->getRepository('CMSConfiguracoesBundle:Estado')->findBy(array("sigla" => 'SC'));
        $cidades = $em->getRepository('CMSConfiguracoesBundle:Cidade')->findBy(array());

        $builder
            ->add('nome', 'text', array('attr' => array('class' => 'form-control')))
            ->add('estado', null, array('attr' => array('class' => 'cms_regiao_estado')))
            ->add('cidades', 'entity', array(
                        'auto_initialize' => false,
                        'class' => 'CMSConfiguracoesBundle:Cidade',
                        'multiple' => true,
                        'choices' => $cidades))
            ;

        /*$ff = $builder->getFormFactory();
        $em = $this->em;

        $func = function (FormEvent $e) use ($ff, $em) {
            $data = $e->getData();
            $form = $e->getForm();

            //$estado = isset($data['estado'])?$data['estado']:null;
            if($data->getEstado()) {
                if ($form->has('cidades')) {
                    $form->remove('cidades');
                }
                echo $data->getEstado()->getSigla();

                $cidades = $em->getRepository('CMSConfiguracoesBundle:Cidade')->findBy(array("estado" => $data->getEstado()));

                $options = array(
                    'class' => 'CMSConfiguracoesBundle:Cidade',
                    'label' => 'oi: ' . $data->getEstado()->getSigla(),
                    'auto_initialize' => false,
                    'multiple' => true,
                    'choices' => $cidades);

                $form->add($ff->createNamed('cidades', 'entity', null, $options));
            }    
        };

        // Register the function above as EventListener on PreSet and PreBind
        $builder->addEventListener(FormEvents::PRE_SET_DATA, $func);
        $builder->addEventListener(FormEvents::PRE_BIND, $func);*/
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
