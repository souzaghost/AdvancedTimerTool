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

namespace advancedtimertool\timer;

interface Timer
{

    /**
     * @return integer
     */
    public function getId() : int;

    /**
     * Called in each tick
     * 
     * @return integer Amount of ticks to update again (if zero or lower it will be ignored)
     */
    public function onUpdate() : int;


    /**
     * Called when the Scheduler's task is disabled
     * @param integer $ticksRemaning
     * @return void
     */
    public function onSchedulerDisabled(int $ticksRemaning);


}