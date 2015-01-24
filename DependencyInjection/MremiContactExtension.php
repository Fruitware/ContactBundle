<?php

/*
 * This file is part of the Mremi\ContactBundle Symfony bundle.
 *
 * (c) Rémi Marseille <marseille.remi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mremi\ContactBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class MremiContactExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('controller.xml');
        $loader->load('form.xml');
        $loader->load('listeners.xml');
        $loader->load('block.xml');

        $this->configureContactManager($container, $config, $loader);
        $this->configureForm($container, $config);
        $this->configureMailer($container, $config, $loader);
    }

    /**
     * Configures the contact manager service
     *
     * @param ContainerBuilder $container A container builder instance
     * @param array            $config    An array of configuration
     * @param XmlFileLoader    $loader    An XML file loader instance
     */
    private function configureContactManager(ContainerBuilder $container, array $config, XmlFileLoader $loader)
    {
        if (true === $config['store_data']) {
            $loader->load('orm.xml');

            $suffix = 'doctrine';
        } else {
            $loader->load('model.xml');

            $suffix = 'default';
        }

        $container->setAlias('mremi_contact.contact_manager', sprintf('mremi_contact.contact_manager.%s', $suffix));

        $definition = $container->findDefinition('mremi_contact.contact_manager');
        $definition->replaceArgument(0, $config['contact_class']);
    }

    /**
     * Configures the form services
     *
     * @param ContainerBuilder $container A container builder instance
     * @param array            $config    An array of configuration
     */
    private function configureForm(ContainerBuilder $container, array $config)
    {
        $container->setParameter('mremi_contact.form.name', $config['form']['name']);
        $container->setParameter('mremi_contact.form.type', $config['form']['type']);
        $container->setParameter('mremi_contact.form.validation_groups', $config['form']['validation_groups']);

        $container->setParameter('mremi_contact.contact.class',     $config['contact_class']);
        $container->setParameter('mremi_contact.form.captcha_type', $config['form']['captcha_type']);
    }

    /**
     * Configures the mailer service
     *
     * @param ContainerBuilder $container A container builder instance
     * @param array            $config    An array of configuration
     * @param XmlFileLoader    $loader    An XML file loader instance
     */
    private function configureMailer(ContainerBuilder $container, array $config, XmlFileLoader $loader)
    {
        $container->setAlias('mremi_contact.mailer', $config['email']['mailer']);

        if ('mremi_contact.mailer.twig_swift' !== $config['email']['mailer']) {
            return;
        }

        $loader->load('mailer.xml');

        $definition = $container->findDefinition('mremi_contact.mailer');
        $definition->replaceArgument(2, $config['email']['recipient_address']);
        $definition->replaceArgument(3, $config['email']['template']);
    }
}
