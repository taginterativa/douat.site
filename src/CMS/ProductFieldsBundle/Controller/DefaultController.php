<?php

namespace CMS\ProductFieldsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CMSProductFieldsBundle:Default:index.html.twig');
    }
}
