<?php

namespace CMS\CoresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CMSCoresBundle:Default:index.html.twig');
    }
}
