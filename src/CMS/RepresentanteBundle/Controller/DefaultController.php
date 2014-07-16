<?php

namespace CMS\RepresentanteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CMSRepresentanteBundle:Default:index.html.twig');
    }
}
