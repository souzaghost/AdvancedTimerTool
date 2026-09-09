<?php

declare (strict_types=1);
 
/***
 *   
 *  AdvancedTimerToolLoader
 * 
 *   █████╗ ████████╗████████╗
 *  ██╔══██╗╚══██╔══╝╚══██╔══╝
 *  ███████║   ██║      ██║   
 *  ██╔══██║   ██║      ██║   
 *  ██║  ██║   ██║      ██║   
 *  ╚═╝  ╚═╝   ╚═╝      ╚═╝   
 *
 * 
 * GitHub: https://github.com/souzaghost/AdvancedTimerTool
 * 
 * This is a advanced timer dev tool 
 * 
 * You must to use SmartCommand framework to use this tool: https://github.com/RajadorDev/SmartCommand
 * 
 * Created by:
 * 
**/

namespace advancedtimertool;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use SmartCommand\utils\SingletonTrait;
use pocketmine\scheduler\ServerScheduler;

class AdvancedTimerToolLoader extends PluginBase
{
 
    use SingletonTrait;
 
    public function onLoad()
    {
        self::setInstance($this);
    }

    public function onEnable()
    {
        if (!file_exists($dir = $this->getDataFolder()))
        {
            mkdir($dir);
        }
    }

    public function onDisable()
    {
    }

    /**
     * @param string $identifier
     * @param mixed $defaultValue
     * @param boolean $warnConsole
     * @return mixed
     */
    public function getConfigValue(string $identifier, $defaultValue = null, bool $warnConsole = true)
    {
        $settings = $this->getConfig();
        if ($settings->exists($identifier)) {
            return $settings->get($identifier);
        } else if ($warnConsole) {
            $this->getLogger()->warning("Setting with id $identifier does not found!");
        }
        return $defaultValue;
    }

    public function registerListener(Listener $listener)
    {
        Server::getInstance()->getPluginManager()->registerEvents($listener, $this);
    }

}