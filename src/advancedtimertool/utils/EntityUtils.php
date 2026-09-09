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

use pocketmine\level\Location;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\DoubleTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\FloatTag;

class EntityUtils
{

    public static function getDefaultCompound(Location $where) : CompoundTag
    {
        return new CompoundTag(
            '',
            [
                new ListTag('Pos', [
                    new DoubleTag('', $where->x),
                    new DoubleTag('', $where->y),
                    new DoubleTag('', $where->z)
                ]),
                new ListTag('Rotation', [
                    new FloatTag('', $where->yaw),
                    new FloatTag('', $where->pitch)
                ])
            ]
        );
    }

}