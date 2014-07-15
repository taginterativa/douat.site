<?php

namespace SITE\ProductCategoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    public function indexAction($product_slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMS\ProductBundle\Entity\Product')
            ->findOneBySlug($product_slug);

        return $this->render('ProductCategoryBundle:Product:index.html.twig', array(
            'Product' => $entity,
        ));
    }
}
