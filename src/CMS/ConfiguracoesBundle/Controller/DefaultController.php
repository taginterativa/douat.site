<?php

namespace CMS\ConfiguracoesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CMSConfiguracoesBundle:Default:index.html.twig', array('name' => $name));
    }
}
