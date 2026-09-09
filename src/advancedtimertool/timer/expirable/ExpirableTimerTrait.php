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

namespace advancedtimertool\timer\expirable;

use advancedtimertool\timer\BaseTimerTrait;
use advancedtimertool\timer\Timer;
use advancedtimertool\timer\TimerScheduler;

trait ExpirableTimerTrait 
{

    use BaseTimerTrait;

    public function onUpdate() : int
    {
        $this->onExpire();
        return 0;
    }

    /**
     * Called when the timer is expired
     *
     * @return void
     */
    abstract protected function onExpire();
}