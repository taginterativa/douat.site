<?php

namespace SITE\ProductCategoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction($category_slug = null, $subcategory_slug = null)
    {
        /*$em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')
            ->findAll();

        return $this->render('ProductCategoryBundle:Default:index.html.twig', array(
            'Categories'        => $entity,
            'TituloCategoria'   => 'Malhas',
            'HeadImage'         => $entity[rand(0, (count($entity) - 1))]->getImage(),
            'Familias'          => $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')->getFamilias(),
            'Acabamentos'       => $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')->getAcabamentos(),
            'Cores'             => $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')->getCores(),
            'category_slug'     => $category_slug,
            'subcategory_slug'  => $subcategory_slug,
        ));*/

        return $this->redirect('malhas/fitness/lancamentos');
    }


    public function categoryAction($category_slug, $subcategory_slug = null)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')
            ->findByCategoryAndSubCategory($category_slug, $subcategory_slug);

        if(count($entity))
        {
            if($entity[0]->getParent())
            {
                $titulo = $entity[0]->getParent()->getName();
                $category_id = $entity[0]->getParent()->getId();
            }
            else
            {
                $titulo = $entity[0]->getName();
                $category_id = $entity[0]->getId();
            }
            $image = $entity[0]->getImage();
        }
        else
        {
            $titulo = $category_slug;
            $category_id = 1;
            $image  = null;
        }


        return $this->render('ProductCategoryBundle:Default:index.html.twig', array(
            'Categories'        => $entity,
            'TituloCategoria'   => $titulo,
            'HeadImage'         => $image,
            'Familias'          => $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')->getFamilias(),
            'Acabamentos'       => $em->getRepository('CMS\ProductBundle\Entity\Acabamento')->findAll(),
            'Cores'             => $em->getRepository('CMS\ProductBundle\Entity\Color')->findByProductCategory($category_id),
            'category_slug'     => $category_slug,
            'subcategory_slug'  => $subcategory_slug,
            'familia'           => $category_slug,
            'acabamento'        => null,
            'cor'               => null,
        ));
    }

    public function buscaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')->search($request);

        $Category = $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')->findOneBySlug($request->get('familia'));

        return $this->render('ProductCategoryBundle:Default:search.html.twig', array(
            'Products'        => $entity,
            'TituloCategoria'   => $Category->getName(),
            'HeadImage'         => $Category->getImage(),
            'Familias'          => $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')->getFamilias(),
            'Acabamentos'       => $em->getRepository('CMS\ProductBundle\Entity\Acabamento')->findAll(),
            'Cores'             => $em->getRepository('CMS\ProductBundle\Entity\Color')->findByProductCategory($Category->getId()),
            'category_slug'     => $request->get('familia'),
            'subcategory_slug'  => null,
            'familia'           => $request->get('familia'),
            'acabamento'        => $request->get('acabamento'),
            'cor'               => $request->get('cor'),
            'malha'             => $request->get('malha'),
            'listar'            => $request->get('listar')
        ));
    }


    public function subsAction($category_id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMS\ProductBundle\Entity\ProductCategory')->getSubCategories($category_id);

        $_arr = array();
        foreach($entity as $Category)
        {
            $_arr[$Category->getId()] = $Category->getName();
        }

        echo json_encode($_arr);
        exit;
    }
}
