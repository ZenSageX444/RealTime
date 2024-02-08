<?php

namespace ZenSageX444\RealTime;

use pocketmine\plugin\PluginBase;

class RealTime extends PluginBase{
    
    private string $prefix = "§cR§6e§ea§al§fTime:";
    
    public function getPrefix(): String{
        return $this->prefix;
    }
    
    public function onLoad(): void{
        $this->getLogger()->info($this->getPrefix()." §ei've been loading...");
    }
    
    public function onEnable(): void{
        $this->saveDefaultConfig();
        $this->registerTask();
        $this->getLogger()->info($this->getPrefix()." §ai've been enabled...");
    }
    
    public function onDisable(): void{
        $this->getLogger()->info($this->getPrefix()." §ci've been disable...");
    }
    
    private function registerTask(): void{
        $tick = $this->getConfig()->get("updateTick");
        if(!is_int($tick)){
            $tick = 30;
            $this->getLogger()->info($this->getPrefix()." [§bWarn§f] §6Please put Integer in updateTick §bnow Running §a30 §btick");
        }
        $this->getScheduler()->scheduleRepeatingTask(new scheduler\RealTimeTask($this), $tick);
    }

}
