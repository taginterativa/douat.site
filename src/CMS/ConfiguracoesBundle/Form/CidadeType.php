<?php

namespace CMS\ConfiguracoesBundle\Form;

use CMS\ConfiguracoesBundle\Entity\Cidade;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CidadeType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', 'text', array('attr' => array('class' => 'form-control')))
            ->add('ddd', 'text', array('attr' => array('class' => 'form-control')))
            ->add('capital', null, array('required' => false))
            ->add('estado')
            ->add('image', 'file', array('required'  => false, 'data_class' => null ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CMS\ConfiguracoesBundle\Entity\Cidade'
        ));
    }

    public static function processImage(UploadedFile $uploaded_file, Cidade $cidade)
    {
        $path = 'uploads/cidade/';
        //getClientOriginalName() => Returns the original file name.
        $uploaded_file_info = pathinfo($uploaded_file->getClientOriginalName());
        $file_name =
            "cidade_" .
            $cidade->getId() .
            "." .
            $uploaded_file_info['extension']
        ;

        $uploaded_file->move($path, $file_name);

        return $file_name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cms_configuracoesbundle_cidade';
    }
}
