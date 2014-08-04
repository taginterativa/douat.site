<?php

namespace SITE\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function aboutAction()
    {

        $page = $this->_getPageContent(1);

        return $this->render('SITEPageBundle:Default:about.html.twig', array(
            'fundo' => $page->getImagem(),
            'texto' => $page->getDescricao()
        ));
    }


    public function servicesAction()
    {
        $page = $this->_getPageContent(2);

        return $this->render('SITEPageBundle:Default:services.html.twig', array(
            'fundo' => $page->getImagem(),
            'texto' => $page->getDescricao()
        ));
    }



    private function _getPageContent($pageId)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('CMSPageBundle:Paginas')->find($pageId);
    }
}
