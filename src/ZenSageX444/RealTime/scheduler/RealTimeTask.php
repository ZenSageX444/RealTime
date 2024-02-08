<?php

namespace ZenSageX444\RealTime\scheduler;

use pocketmine\world\World;
use pocketmine\scheduler\Task;

use ZenSageX444\RealTime\RealTime;
use ZenSageX444\RealTime\utils\RealTimeUtils;

class RealTimeTask extends Task{
    
    private RealTime $plugin;
    private int $worldTime;
    
    public function __construct(RealTime $plugin){
        $this->plugin = $plugin;
        $this->worldTime = RealTimeUtils::getCurrentTimeInMinecraftTime();
    }
    
    public function getPlugin(): RealTime{
        return $this->plugin;
    }
    
    public function onRun(): void{
        $server = $this->getPlugin()->getServer();
        foreach($server->getWorldManager()->getWorlds() as $world){
            if(!$this->isDisableWorld($world)){
                $world->setTime($this->worldTime);
            }
        }
    }
    
    private function isDisableWorld(World $world): bool {
		$worldname = $world->getFolderName();
		$disableWorld = $this->getPlugin()->getConfig()->get("disableWorld");

		if ($disableWorld == null) {
			return false;
		}

		foreach ($disableWorld as $entry) {
			if (strpos($worldname, $entry) !== false) {
				return true;
			}
		}

		return false;
	}
}
