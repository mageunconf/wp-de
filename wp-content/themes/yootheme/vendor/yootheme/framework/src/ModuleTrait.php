<?php

namespace YOOtheme;

trait ModuleTrait
{
    /**
     * @see ModuleManager::load
     */
    public function load($modules = [])
    {
        $this['modules']->load($modules);

        return $this;
    }

    /**
     * @see ModuleManager::register
     */
    public function register($paths, $basePath = null)
    {
        $this['modules']->register($paths, $basePath);

        return $this;
    }

    /**
     * @see ModuleManager::addLoader
     */
    public function addLoader(callable $loader, $filter = null)
    {
        $this['modules']->addLoader($loader, $filter);

        return $this;
    }
}
