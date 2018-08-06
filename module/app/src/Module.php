<?php

namespace App;

class Module
{
    public function getConfig()
    {
        $configProvider = new ConfigProvider;

        return [
            'service_manager' => $configProvider->getServiceManagerConfig(),
            'application' => [
                'service_manager' => $configProvider->getApplicationManagerConfig()
            ],
            'repo_plugin_manager' => $configProvider->getRepoPluginManagerConfig(),
            'entity_registry' => [
                'entities' => $configProvider->getEntityRegistry(),
            ],
        ];
    }

    public static function getNamespace()
    {
        return __NAMESPACE__;
    }
}
