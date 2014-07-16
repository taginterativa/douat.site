<?php

namespace CMS\ProductBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ProductCategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductCategoryRepository extends EntityRepository
{
    public function getFamilias()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM CMSProductBundle:ProductCategory c WHERE c.parent IS NULL ORDER BY c.name ASC'
            )
            ->getResult();
    }

    public function getAcabamentos()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM CMSProductBundle:ProductCategory c WHERE c.parent IN
                    (SELECT c2.id FROM CMSProductBundle:ProductCategory c2 WHERE c2.parent IS NULL)
                ORDER BY c.name ASC'
            )
            ->getResult();
    }

    public function getCores()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM CMSProductBundle:ProductCategory c WHERE c.id NOT IN
                    (SELECT c2.id FROM CMSProductBundle:ProductCategory c2 WHERE c2.parent IN
                      (SELECT c3.id FROM CMSProductBundle:ProductCategory c3 WHERE c3.parent IS NULL)
                    ) AND c.parent IS NOT NULL
                ORDER BY c.name ASC'
            )
            ->getResult();
    }

    public function findByCategoryAndSubCategory($category, $subcategory)
    {
        if(is_null($subcategory))
        {
            return $this->findByChildren($category);
        }
        else
        {
            return $this->findBySlug($category . '-' . $subcategory);
        }
    }


    public function findByChildren($parentCategory)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM CMSProductBundle:ProductCategory c WHERE c.parent IN
                    (SELECT c2.id FROM CMSProductBundle:ProductCategory c2 WHERE c2.parent IS NULL AND c2.slug = \'' . $parentCategory . '\')
                ORDER BY c.name ASC'
            )
            ->getResult();
    }


    public function getSubCategories($category_id)
    {
        $q = $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM CMSProductBundle:ProductCategory c WHERE c.parent = '. $category_id .' ORDER BY c.name ASC'
            );

        return $q->getResult();
    }



    public function search($request)
    {
        $repository = $this->getEntityManager()->getRepository('CMSProductBundle:Product');

        $query = $repository->createQueryBuilder('p');

        if($request->get('familia'))
        {
            $query->innerJoin('p.productCategory', 'c');
            $query->andWhere("c.slug LIKE '%" . $request->get('familia') . "%'");
        }

        if($request->get('listar'))
        {
            $query->andWhere("c.slug LIKE '%" . $request->get('listar') . "%'");
        }

        if($request->get('malha') || $request->get('acabamento') || $request->get('cor'))
        {
            if($request->get('malha'))
            {
                $query->andWhere("p.name LIKE '%" . $request->get('malha') . "%'");
            }

            if($request->get('acabamento'))
            {
                $query->innerJoin('p.acabamento', 'a');
                $query->andWhere("a.name LIKE '%" . $request->get('acabamento') . "%'");
            }

            if($request->get('cor'))
            {
                $query->innerJoin('p.productColor', 'cor');
                $query->andWhere("cor.name LIKE '%" . $request->get('cor') . "%'");
            }
        }

        return $query->getQuery()->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_OBJECT);
    }
}
