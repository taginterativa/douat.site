<?php

namespace CMS\CoresBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ColorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ColorRepository extends EntityRepository
{
    /**
     * Obtém as cores que existem dentro de uma categoria
     * @param $category_slug
     * @return \Doctrine\ORM\Query | Array
     */
    public function findByProductCategory($category_id)
    {
        $Query = $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM CMSCoresBundle:Color c
                    WHERE c.id IN (
                        SELECT c3.id FROM CMSProductBundle:ProductColor c2
                        INNER JOIN c2.color c3
                        INNER JOIN c2.product p
                        INNER JOIN p.productCategory pc
                        WHERE p.productCategory = '. $category_id .'
                        OR pc.parent = '. $category_id .'
                    )'
            );

        return $Query->getResult();

    }
}