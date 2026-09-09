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

use advancedtimertool\AdvancedTimerToolLoader;
use advancedtimertool\task\TimerSchedulerTask;
use InvalidArgumentException;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\Task;
use pocketmine\Server;
use SmartCommand\utils\SingletonTrait;
use Throwable;

class TimerScheduler
{

    /** @var int */
    protected $currentIdGenerator = 0;

    /** @var int */
    protected $currentTick = 0;

    /** @var array<int,array<int,Timer>> */
    protected $scheduledUpdates = [];

    /** @var array<int,Timer> */
    protected $timerMap = [];

    /** @var PluginBase */
    protected $plugin;

    public function __construct(PluginBase $plugin)
    {
        $this->initTask();
        $this->plugin = $plugin;
    }

    protected function initTask()
    {
        Server::getInstance()->getScheduler()->scheduleRepeatingTask(
            $this->createTask(),
            1
        );
    }

    /**
     * @return Task
     */
    protected function createTask() : Task
    {
        return new TimerSchedulerTask(AdvancedTimerToolLoader::getInstance(), $this);
    }

    public function generateTimerId() : int 
    {
        return $this->currentIdGenerator++;
    }

    public function cancelTimer(Timer $timer) : bool 
    {
        $id = $timer->getId();
        if (isset($this->timerMap[$id])) {
            $scheduleId = $this->timerMap[$id];
            unset($this->scheduledUpdates[$scheduleId][$id]);
            unset($this->timerMap[$id]);

            if (empty($this->timerMap)) {
                $this->resetUpdater();
            }
            return true;
        }
        return false;
    }

    public function isScheduled(Timer $timer) : bool 
    {
        return isset($this->timerMap[$timer->getId()]);
    }

    /**
     * Schedule timer update to the next tick
     * @param Timer $timer
     * @param int $ticks
     */
    public function schedule(Timer $timer, int $ticks)
    {
        $timerId = $timer->getId();

        if ($ticks <= 0) {
            throw new InvalidArgumentException("Ticks param must be bigger than zero");
        }

        $this->cancelTimer($timer);
        $updateTime = $ticks + $this->currentTick;
        $this->timerMap[$timerId] = $updateTime;
        if (!isset($this->scheduledUpdates[$updateTime])) {
            $this->scheduledUpdates[$updateTime] = [];
        }
        $this->scheduledUpdates[$updateTime][] = $timer;
    }

    public function onUpdate()
    {
        if (empty($this->timers)) {
            return;
        }

        $currentTick = $this->currentTick += 1;

        if (isset($this->scheduledUpdates[$currentTick])) {
            foreach ($this->scheduledUpdates[$currentTick] as $timer) {
                try {
                    $nextUpdate = $timer->onUpdate();
                } catch (Throwable $error) {
                    $this->cancelTimer($timer);
                    AdvancedTimerToolLoader::getInstance()->getLogger()->error("Error while updating " . get_called_class() . ' scheduler: ' . ((string) $error));
                    continue;
                }
                if ($nextUpdate > 0) {
                    $this->schedule($timer, $nextUpdate);
                    continue;
                }
                $this->cancelTimer($timer);
            }
        }
    }

    protected function resetUpdater()
    {
        $this->currentTick = 0;
    }

    


}