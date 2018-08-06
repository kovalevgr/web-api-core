<?php

namespace App\Utils;

class ModuleConfigProvider
{
    /**
     * @var string
     */
    private $moduleClass;

    public function __construct(string $moduleClass)
    {
        $this->moduleClass = $moduleClass;
    }

    /**
     * @return array
     */
    public function __invoke() : array
    {
        $moduleClass = $this->moduleClass;

        if (!class_exists($moduleClass)) {
            throw new \UnexpectedValueException(sprintf(
                "Cannot read config from %s - class cannot be loaded.",
                $moduleClass
            ));
        }

        $module = new $moduleClass;

        if (method_exists($module, 'getConfig')) {
            return $module->getConfig();
        }

        return [];
    }
}