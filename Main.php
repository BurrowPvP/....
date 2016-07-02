<?php

namespace Secret;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use pocketmine\level\Position;
use pocketmine\level\Level;
use pocketmine\math\Vector3;
use pocketmine\scheduler\CallbackTask;
use pocketmine\plugin\Plugin;
use pocketmine\tile\Sign;
use pocketmine\tile\Tile;
use pocketmine\scheduler\PluginTask;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\Server;
use pocketmine\block\Block;
use pocketmine\scheduler\scheduleDelayedRepeatingTask;
use pocketmine\event\block\BlockBreakEvent;

Class Main extends PluginBase implements Listener{
    
    public $queue = array();
    public $players = array();
    
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getLogger()->Info("geht");
    }
    public function onPlayerTouch(PlayerInteractEvent $event){
	$player = $event->getPlayer();
	$b = $event->getBlock();
	$name = $event->getPlayer()->getName();
	$name = strtolower($name);
	if($b->getId() == 63 || $b->getId() == 68 || $b->getId() == 323){ 
	    $sign = $player->getLevel()->getTile($b);
	    if(!($sign instanceof Sign)){
		return;
            }
	    $sign = $sign->getText();
            if(TextFormat::clean($sign[0]) === 'SuperJump'){
                if(in_array($event->getPlayer()->getName(), $this->queue)){
                    $event->getPlayer()->sendMessage("Du bist bereits in der Warteschlange!");
                }
                else{
                    array_push($this->queue, $event->getPlayer()->getName());
                    $event->getPlayer()->sendMessage("Du bist nun in der Warteschlange!");
                    $this->abfrage();
                }
            }
        }
    }
    private function abfrage(){
        // ....
    }
}
