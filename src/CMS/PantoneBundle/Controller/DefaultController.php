<?php

namespace CMS\PantoneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CMSPantoneBundle:Default:index.html.twig');
    }
}
