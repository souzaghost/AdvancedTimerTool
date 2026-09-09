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

namespace advancedtimertool\utils;

use pocketmine\scheduler\Task;
use pocketmine\Server;

class ClosureTask extends Task
{

    /** @var callable `() : void` */
    protected $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function onRun($currentTick)
    {
        ($this->callback)();
    }

    /**
     * @param integer $ticks
     * @param callable $callback `() : void`
     * @return ClosureTask
     */
    public static function scheduleDelayed(int $ticks, callable $callback) : ClosureTask
    {
        Server::getInstance()->getScheduler()->scheduleDelayedTask($task = new self($callback), $ticks);
        return $task;
    }

}