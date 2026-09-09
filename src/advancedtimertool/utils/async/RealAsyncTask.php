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

namespace advancedtimertool\utils\async;

use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;

/**
 * Pocketmine 2, does not save thread store values correctly. 
 * So i (Rajador) created this class to replace default pm2 async task save methods.
 */
abstract class RealAsyncTask extends AsyncTask
{

    public function saveToThreadStore($identifier, $value)
    {
        $identifier = $this->createThreadStoreId($identifier);
        return parent::saveToThreadStore($identifier, $value);
    }

    public function getFromThreadStore($identifier)
    {
        $identifier = $this->createThreadStoreId($identifier);
        return parent::getFromThreadStore($identifier);
    }

    protected function createThreadStoreId(string $name) : string 
    {
        return spl_object_hash($this) . ':' . $name;
    }

    public static function schedule(RealAsyncTask $task) : RealAsyncTask
    {
        Server::getInstance()->getScheduler()->scheduleAsyncTask($task);
        return $task;
    }

}