<?php

namespace CMS\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CMSDashboardBundle:Default:index.html.twig', array('error' => null));
    }
}
