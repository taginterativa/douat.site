<?php

namespace CMS\ContatoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CMSContatoBundle:Default:index.html.twig', array('name' => $name));
    }
}
