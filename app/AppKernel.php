<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new CMS\UserBundle\CMSUserBundle(),
            new CMS\DashboardBundle\CMSDashboardBundle(),
            new CMS\ConfiguracoesBundle\CMSConfiguracoesBundle(),
            new CMS\ContatoBundle\CMSContatoBundle(),
            new SITE\HomeBundle\HomeBundle(),
            new SITE\ContatoBundle\ContatoBundle(),
            new CMS\PantoneBundle\CMSPantoneBundle(),
            new CMS\CoresBundle\CMSCoresBundle(),
            new CMS\ProductFieldsBundle\CMSProductFieldsBundle(),
            new CMS\ProductBundle\CMSProductBundle(),
            new SITE\ProductCategoryBundle\ProductCategoryBundle(),
            new SITE\PageBundle\SITEPageBundle(),
            new CMS\RepresentanteBundle\CMSRepresentanteBundle(),
            new SITE\RepresentantesBundle\SITERepresentantesBundle(),
            new SITE\TrabalheBundle\SITETrabalheBundle(),
            new CMS\PageBundle\CMSPageBundle(),
            new CMS\BannerBundle\CMSBannerBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
