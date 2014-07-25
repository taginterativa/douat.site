<?php

namespace SITE\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function aboutAction()
    {
        return $this->render('SITEPageBundle:Default:about.html.twig', array(
            'texto' => $this->_getPageContent(1)
        ));
    }


    public function servicesAction()
    {
        return $this->render('SITEPageBundle:Default:services.html.twig', array(
            'texto' => $this->_getPageContent(2)
        ));
    }



    private function _getPageContent($pageId)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('CMSPageBundle:Paginas')->find($pageId)->getDescricao();
    }
}
