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

use advancedtimertool\timer\TimerScheduler;
use advancedtimertool\utils\TimeUtils;

trait ExpirableTimestampTrait
{

    use ExpirableTimerTrait;

    /** @var float **/
    protected $expireTimestamp;

    public function __construct(
        TimerScheduler $scheduler,
        float $expireTime
    ) {
        $this->expireTimestamp = $expireTime;
        $this->prepareTimer($scheduler);
        $this->scheduleOrExpire();
    }

    public function getTicksRemaning() : int 
    {
        $now = microtime(true);
        if ($now >= $this->expireTimestamp) {
            return 0;
        }
        return TimeUtils::timestampToTicks($this->expireTimestamp - $now);
    }

    protected function scheduleOrExpire()
    {
        $ticks = $this->getTicksRemaning();
        if ($ticks > 0) {
            return $this->schedule($ticks);
        }
        $this->onExpire();
    }

}