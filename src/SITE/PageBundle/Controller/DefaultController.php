<?php

namespace SITE\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function aboutAction()
    {
        return $this->render('SITEPageBundle:Default:about.html.twig');
    }


    public function servicesAction()
    {
        return $this->render('SITEPageBundle:Default:services.html.twig');
    }
}
