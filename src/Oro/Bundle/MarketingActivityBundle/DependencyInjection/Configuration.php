<?php

namespace Oro\Bundle\MarketingActivityBundle\DependencyInjection;

use Oro\Bundle\ConfigBundle\DependencyInjection\SettingsBuilder;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('oro_marketing_activity');

        SettingsBuilder::append(
            $rootNode,
            [
                'feature_enabled' => ['value' => true],
            ]
        );

        return $treeBuilder;
    }
}
