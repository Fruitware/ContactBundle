<?php

/*
 * This file is part of the Fruitware\ContactBundle Symfony bundle.
 *
 * (c) Coroliov Oleg <coroliov.o@fruitware.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fruitware\ContactBundle\DependencyInjection;

use Fruitware\ContactBundle\Model\BaseContactInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fruitware_contact');

        $rootNode
            ->children()
                ->booleanNode('store_data')->defaultFalse()->end()
                ->scalarNode('contact_class')
                    ->defaultValue('Fruitware\ContactBundle\Model\BaseContact')->cannotBeEmpty()
                ->end()
                ->arrayNode('form')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('type')->defaultValue('base_fruitware_contact')->cannotBeEmpty()->end()
                        ->scalarNode('name')->defaultValue('contact_form')->cannotBeEmpty()->end()
                        ->scalarNode('handler')->defaultValue('fruitware_contact.form.handler.default')->cannotBeEmpty()->end()
                        ->arrayNode('validation_groups')
                            ->prototype('scalar')->end()
                            ->defaultValue(array('Default'))
                        ->end()
                        ->scalarNode('subject_provider')->defaultValue('fruitware_contact.subject_provider.noop')->cannotBeEmpty()->end()
                        ->scalarNode('captcha_type')->defaultNull()->cannotBeEmpty()->end()
                    ->end()
                ->end()
                ->arrayNode('email')
                    ->isRequired()
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('mailer')->defaultValue('fruitware_contact.mailer.twig_swift')->cannotBeEmpty()->end()
                        ->scalarNode('recipient_address')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('template')->defaultValue('FruitwareContactBundle:Contact:email.txt.twig')->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end()
            ->validate()
                ->ifTrue(function($v) { return true === $v['store_data'] && ('Fruitware\ContactBundle\Model\BaseContact' === $v['contact_class'] || 'Fruitware\ContactBundle\Model\Contact' === $v['contact_class']); })
                ->thenInvalid('You must configure the "contact_class" node with your extended entity.')
            ->end()
        ;


        return $treeBuilder;
    }
}
