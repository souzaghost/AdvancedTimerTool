<?php

namespace advancedtimertool\utils;

use pocketmine\plugin\Plugin;
use pocketmine\utils\Config;

/**
 * @see Plugin
 */
trait ResourceLoader
{

    /**
     * 
     * @param string $file
     * @return bool
     */
    public static function isPharFile(string $file): bool
    {
        return (pathinfo($file, PATHINFO_EXTENSION) == 'phar');
    }

    /**
     * 
     * @param bool $sendSuccessMessage
     * @return void
     */
    public function loadResources(bool $sendSuccessMessage = true)
    {
        $filename = $this->loadPluginFile($this->getFile());
        $file = new Config($filename . 'plugin.yml', Config::YAML);

        $resources = $file->get('resources', null);

        if (is_null($resources)) {

            throw new \Exception("Index 'resources' not found");
        } elseif (!is_array($resources)) {

            throw new \Exception("Index 'resources' isn't type string[]");
        }

        foreach ($resources as $resource) {
            
            if (!is_string($resource)) {

                throw new \Exception("Index values of 'resources' must be string[]. Type return: " . gettype($resource));
            }

            if (!file_exists("{$filename}resources/{$resource}")) {

                throw new \Exception("Resource '$resource' not found");
            }
            
            $resource = $this->getDataFolder() . $resource;
            if (!file_exists($resource)) {

                mkdir($resource, 0777 , true);

                $this->saveResource($resource);
            }
        }

        if ($sendSuccessMessage) 
        {
            $this->getLogger()->info("§aResources loaded successfully");
        }
    }

    /**
     * 
     * @param string $file
     * @return string
     */
    private function loadPluginFile(string $file): string
    {
        if (self::isPharFile($file)) {

            $file = "phar://$file";
        }

        return $file;
    }

}
