<?php

/*    __ _      _           _             _ _ ____  
 *   / /(_) ___| |__   /\ /(_)_ __   __ _/ / |___ \ 
 *  / / | |/ __| '_ \ / //_/ | '_ \ / _` | | | __) |
 * / /__| | (__| | | / __ \| | | | | (_| | | |/ __/ 
 * \____/_|\___|_| |_\/  \/|_|_| |_|\__, |_|_|_____|
 *                               |___/
 */
 
declare(strict_types=1);
namespace clearskyteam;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\math\Vector3;
use pocketmine\world\sound\BlazeShootSound;

class Main extends PluginBase implements Listener {
	
	// —————————— Enable and Disable Logger —————————— //

	public function onEnable() : void{
		$this->getLogger()->notice("is activated!");
		$this->getLogger()->notice("Plugin Author: @ClearSkyTeam");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onDisable() : void{
		$this->getLogger()->notice("is deactivated!");
	}
	
	// —————————— Show Health and Play Sound on Projectile Hit! —————————— //
	
	public function onHit(EntityDamageByEntityEvent $event){
	 if ($event->getCause() === EntityDamageByEntityEvent::CAUSE_PROJECTILE){
			$player = $event->getDamager();
			$level = $player->getWorld();
			if($player instanceof Player){
				$health = $event->getEntity()->getHealth();
				$entity = $event->getEntity()->getNameTag();
				$player->sendMessage("§e" . $entity . " §cis now at§6 " . $health . " §cHP");
				$level->addSound(new BlazeShootSound($player->asVector3()));

			}
		}
	}
}
