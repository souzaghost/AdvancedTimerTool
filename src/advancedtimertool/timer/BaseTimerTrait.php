<?php

declare (strict_types=1);
 
/***
 *   
 * Rajador Developer 
 * 
 *  ██████╗  █████╗      ██╗ █████╗ ██████╗  ██████╗ ██████╗ 
 *  ██╔══██╗██╔══██╗     ██║██╔══██╗██╔══██╗██╔═══██╗██╔══██╗
 *  ██████╔╝███████║     ██║███████║██║  ██║██║   ██║██████╔╝
 *  ██╔══██╗██╔══██║██   ██║██╔══██║██║  ██║██║   ██║██╔══██╗
 *  ██║  ██║██║  ██║╚█████╔╝██║  ██║██████╔╝╚██████╔╝██║  ██║
    ╚═╝  ╚═╝╚═╝  ╚═╝ ╚════╝ ╚═╝  ╚═╝╚═════╝  ╚═════╝ ╚═╝  ╚═╝
 * 
 * GitHub: https://github.com/rajadordev
 * 
 * Discord: rajadortv
 * 
 * @copyright 2023 - 2027 Rajador Developer
 * 
 * This system is protected by laws! Anyone who shares or resells it will be held accountable
 *
 * Edição, compartilhamento ou revenda é proibido por LEI! Quem fizer será responsabilizado judicialmente
 * 
**/

namespace advancedtimertool\timer;

use RuntimeException;

trait BaseTimerTrait
{

    /** @var TimerScheduler */
    protected $scheduler;

    /** @var int */
    private $schedulerTimerId;

    /**
     * @param TimerScheduler $scheduler
     * @param integer|null $scheduleTicks
     * @return $this
     */
    protected function prepareTimer(TimerScheduler $scheduler, int $scheduleTicks = null) : self
    {
        if (isset($this->scheduler)) {
            throw new RuntimeException("Scheduler is already defined");
        }   
        $this->scheduler = $scheduler;
        $this->schedulerTimerId = $scheduler->generateTimerId();

        if (is_int($scheduleTicks)) {
            $this->schedule($scheduleTicks);
        }
        return $this;
    }

    final public function getId() : int 
    {
        return $this->schedulerTimerId;
    }

    public function isScheduled() : bool 
    {
        if (isset($this->scheduler)) {
            return $this->scheduler->isScheduled($this);
        }

        throw new RuntimeException("Timer has no scheduler yet");
    }

    /**
     * @param integer $ticks
     * @return $this
     */
    public function schedule(int $ticks) : self
    {
        if (!isset($this->scheduler)) {
            throw new RuntimeException("Cannot schedule without scheduler! Timer is not prepared");
        }
        $this->scheduler->schedule($this, $ticks);
        return $this;
    }

    public function cancelSchedule() : bool 
    {
        return $this->scheduler->cancelTimer($this);
    }

}