<?php

namespace SITE\ProductCategoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    public function indexAction($product_slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMS\ProductBundle\Entity\Product')->findOneBySlug($product_slug);

        $lisos = array();
        $estampados = array();

        $list = $entity->getProductColor();
        if(count($list)) {
	        foreach($list as $productColor) {
	        	if(strpos($productColor->getName(),"Estampa") !== false) {
	        		$estampados[] = $productColor;
	        	} else {
	        		$lisos[] = $productColor;
	        	}
	        }
	    }

        return $this->render('ProductCategoryBundle:Product:index.html.twig', array(
            'Product'    => $entity,
            'lisos'      => $lisos,
            'estampados' => $estampados
        ));
    }
}
