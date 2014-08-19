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

        $banners = $em->getRepository("CMSBannerBundle:Banner")->createQueryBuilder("b")
                        ->where("b.isActive = 1")
                        ->orderBy('b.position', 'ASC')
                        ->getQuery()
                        ->getResult();

        //$banners = $em->getRepository("CMSBannerBundle:Banner")->findAll();

        return $this->render('HomeBundle:Default:index.html.twig', array(
                "banners"    => $banners,
        		"bg_malha"   => $em->getRepository('CMSPageBundle:Paginas')->find(3)->getImagem(),
	        	"bg_malha_1" => $em->getRepository('CMSPageBundle:Paginas')->find(4)->getImagem(),
    	    	"bg_malha_2" => $em->getRepository('CMSPageBundle:Paginas')->find(5)->getImagem(),
        		"bg_malha_3" => $em->getRepository('CMSPageBundle:Paginas')->find(6)->getImagem(),
        		"bg_malha_4" => $em->getRepository('CMSPageBundle:Paginas')->find(7)->getImagem()
        	));
    }

}
