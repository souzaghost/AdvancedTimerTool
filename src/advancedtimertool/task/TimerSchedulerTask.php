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

namespace advancedtimertool\task;

use advancedtimertool\timer\TimerScheduler;
use pocketmine\plugin\Plugin;
use pocketmine\scheduler\PluginTask;

class TimerSchedulerTask extends PluginTask
{

    /** @var TimerScheduler */
    protected $scheduler;

    public function __construct(Plugin $owner, TimerScheduler $scheduler)
    {
        parent::__construct($owner);
        $this->scheduler = $scheduler;
    }

    public function onRun($currentTick)
    {
        $this->scheduler->onUpdate();
    }
}