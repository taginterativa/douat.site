<?php

namespace CMS\ConfiguracoesBundle\Extension;

class ToolsTwigExtension extends \Twig_Extension {

    public function getFilters() {
        return array(
            'base64_encode' => new \Twig_Filter_Method($this, 'base64Encode'),
            'base64_decode' => new \Twig_Filter_Method($this, 'base64Decode'),
            'var_dump' => new \Twig_Filter_Method($this, 'varDump'),
        );
    }

    public function getFunctions() {
        return array(
            'i_range' => new \Twig_Function_Method($this, 'iRange'),
        );
    }

    public function getName() {
        return 'tools_twig_extension';
    }

    public function iRange($min,$max){
        $result = array();
        for ($i = $min; $i <= $max; $i++){
            $result[] = $i;
        }
        return $result;
    }

    public function base64Encode($str){
        return base64_encode($str);
    }

    public function base64Decode($str){
        return base64_decode($str);
    }
    public function varDump($str){
        return var_dump($str);
    }
}