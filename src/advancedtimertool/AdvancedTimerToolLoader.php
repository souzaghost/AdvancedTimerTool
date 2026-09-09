<?php

namespace advancedtimertool;

use advancedtimertool\utils\ResourceLoader;
use pocketmine\plugin\PluginBase;
use SmartCommand\utils\SingletonTrait;

class AdvancedTimerToolLoader extends PluginBase
{

    use SingletonTrait;
    use ResourceLoader;

    public function onLoad()
    {
        $this->setInstance($this);
        $this->loadResources();
    }

    public function onEnable()
    {
        
    }

    public function onDisable()
    {
        
    }
}
