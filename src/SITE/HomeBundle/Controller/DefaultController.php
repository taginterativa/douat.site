<?php

namespace SITE\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;


class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
        ;

        return $this->render('HomeBundle:Default:index.html.twig', array(
        		"bg_malha"   => $em->getRepository('CMSPageBundle:Paginas')->find(3)->getImagem(),
	        	"bg_malha_1" => $em->getRepository('CMSPageBundle:Paginas')->find(4)->getImagem(),
    	    	"bg_malha_2" => $em->getRepository('CMSPageBundle:Paginas')->find(5)->getImagem(),
        		"bg_malha_3" => $em->getRepository('CMSPageBundle:Paginas')->find(6)->getImagem(),
        		"bg_malha_4" => $em->getRepository('CMSPageBundle:Paginas')->find(7)->getImagem()
        	));
    }

}
