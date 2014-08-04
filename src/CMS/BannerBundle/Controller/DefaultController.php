<?php

namespace CMS\BannerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CMSBannerBundle:Default:index.html.twig');
    }
}
