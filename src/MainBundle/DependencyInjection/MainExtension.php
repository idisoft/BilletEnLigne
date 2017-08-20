<?php
/**
 * Created by PhpStorm.
 * User: DRISSA
 * Date: 09/03/2017
 * Time: 18:08
 */

namespace MainBundle\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class MainExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader= new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }

}
