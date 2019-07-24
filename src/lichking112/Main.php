<?php

//  _      _      _     _  ___            __ __ ___   
// | |    (_)    | |   | |/ (_)          /_ /_ |__ \  
// | |     _  ___| |__ | ' / _ _ __   __ _| || |  ) | 
// | |____| | (__| | | | . \| | | | | (_| | || |/ /_  
// |______|_|\___|_| |_|_|\_\_|_| |_|\__, |_||_|____| 
//                                    __/ |           
//                                   |___/            

namespace lichking112;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;
use pocketmine\math\Vector3;
use pocketmine\level\sound\AnvilFallSound;

class Main extends PluginBase implements Listener{

	public function onEnable(){
		$this->getLogger()->info("[ENABLED]");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onDisable(){
		$this->getLogger()->info("[DISABLED]");
	}
	
	public function onDamage(EntityDamageEvent $e){
	 if ($e->getCause() === EntityDamageByEntityEvent::CAUSE_PROJECTILE){
			$player = $e->getDamager();
			$level = $player->getLevel();
			if($player instanceof Player){
				$health = $e->getEntity()->getHealth();
				$entity = $e->getEntity()->getNameTag();
				$player->sendMessage(TextFormat::YELLOW . "$entity §6Is On§c $health §6HP§b ❤");
				$level->addSound(new AnvilFallSound($player->asVector3()));

			}
		}
	}
}