<?php
namespace CMS\PageBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CMS\PageBundle\Entity\Paginas;

class LoadPage implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

    	$pagina = new Paginas();
        $pagina->setId(1);
    	$pagina->setNome("A Douat");
    	$pagina->setDescricao(".");
    	$pagina->setIsActive(true);
    	$pagina->setCreatedAt(new \DateTime("now"));
    	$pagina->setUpdatedAt(new \DateTime("now"));
    	$manager->persist($pagina);

    	$pagina = new Paginas();
        $pagina->setId(2);
    	$pagina->setNome("Serviços prestados");
    	$pagina->setDescricao(".");
    	$pagina->setIsActive(true);
    	$pagina->setCreatedAt(new \DateTime("now"));
    	$pagina->setUpdatedAt(new \DateTime("now"));
    	$manager->persist($pagina);

        $pagina = new Paginas();
        $pagina->setId(3);
        $pagina->setNome("Nossas Malhas");
        $pagina->setDescricao(".");
        $pagina->setIsActive(true);
        $pagina->setCreatedAt(new \DateTime("now"));
        $pagina->setUpdatedAt(new \DateTime("now"));
        $manager->persist($pagina);

        $pagina = new Paginas();
        $pagina->setId(4);
        $pagina->setNome("Nossas Malhas Fitness");
        $pagina->setDescricao(".");
        $pagina->setIsActive(true);
        $pagina->setCreatedAt(new \DateTime("now"));
        $pagina->setUpdatedAt(new \DateTime("now"));
        $manager->persist($pagina);

        $pagina = new Paginas();
        $pagina->setId(5);
        $pagina->setNome("Nossas Malhas Lingerie");
        $pagina->setDescricao(".");
        $pagina->setIsActive(true);
        $pagina->setCreatedAt(new \DateTime("now"));
        $pagina->setUpdatedAt(new \DateTime("now"));
        $manager->persist($pagina);

        $pagina = new Paginas();
        $pagina->setId(6);
        $pagina->setNome("Nossas Malhas Escolar");
        $pagina->setDescricao(".");
        $pagina->setIsActive(true);
        $pagina->setCreatedAt(new \DateTime("now"));
        $pagina->setUpdatedAt(new \DateTime("now"));
        $manager->persist($pagina);

        $pagina = new Paginas();
        $pagina->setId(7);
        $pagina->setNome("Nossas Malhas Praia");
        $pagina->setDescricao(".");
        $pagina->setIsActive(true);
        $pagina->setCreatedAt(new \DateTime("now"));
        $pagina->setUpdatedAt(new \DateTime("now"));
        $manager->persist($pagina);

    	$manager->flush();
    }
}