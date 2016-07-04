<?php

namespace SuperJump;

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
use pocketmine\scheduler\scheduleRepeatingTask;
use pocketmine\event\block\BlockBreakEvent;

Class Main extends PluginBase implements Listener{
    
    public $queue = array();
    public $players = array();
    public $TaskHandler;
    public $ingame1 = array();
    public $ingame2 = array();
    public $ingame3 = array();
    public $ingame4 = array();
    public $ingame5 = array();
    
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
    public function abfrage(){
        if(count($this->queue == 2)){
        	$player1 = $this->getServer()->getPlayer($this->queue[0]);
        	$player2 = $this->getServer()->getPlayer($this->queue[1]);
        	if($player1 instanceof Player){
        		if($player2 instanceof Player){
        			$this->teleport($player1, $player2);
        			unset($this->queue[0]);
        			unset($this->queue[1]);
        			if(count($this->ingame1 <= 2)){
        			        array_push($this->ingame1, $player1->getName());
        			        array_push($this->ingame1, $player2->getName());
        			}
        			elseif(count($this->ingame2 <= 2)){
        			        array_push($this->ingame2, $player1->getName());
        			        array_push($this->ingame2, $player2->getName());				
        		        }
        			elseif(count($this->ingame3 <= 2)){
        			        array_push($this->ingame3, $player1->getName());
        			        array_push($this->ingame3, $player2->getName());
        			}
        			elseif(count($this->ingame4 <= 2)){
        			        array_push($this->ingame4, $player1->getName());
        			        array_push($this->ingame4, $player2->getName());
        			}
        			elseif(count($this->ingame5 <= 2)){
        			        array_push($this->ingame5, $player1->getName());
        			        array_push($this->ingame5, $player2->getName());
        			}
        		}
        	}
        }
    }
    public function Teleport(array /* ? */){
    	switch(mt_rand(1, 5)){
            case 1: //map 1
                $player1->teleport(new Vector3()); 
                $player2->teleport(new Vector3());
                break;
            case 2:
                //map 2
                break;
            case 3:
                // map 3
                break;
            case 4:
                // map 4
                break;
            case 5:
                //map 5
                break;
           }
           $task = new CountdownTask($this, $this);
           $this->TaskHandler = Server::getInstance()->getScheduler()->scheduleDelayedRepeatingTask($task, 20, 20);
           //  foreach($this->getServer->getOnlinePlayers as $spieler){
           //  $player1->hideplayer($spieler);
           //  $player2->hideplayer($spieler);
           //  $player1->showplayer($player2);
           //  $player2->showplayer($player1);
    }
}
class CountdownTask extends PluginTask{
    public $seconds = 5;
    
    public function __construct(Plugin $owner) {
     
        parent::__construct($owner);
    }
    
    public function onRun($currentTick) {
    	$this->seconds -= 1;
    	$player1->sendTip("Das Spiel beginnt in " . $this->seconds . "!");
    	$player2->sendTip("Das Spiel beginnt in " . $this->seconds . "!");
    	if($this->seconds == 0){
    		// ...
    		ServerScheduler::cancelTask($this->getTaskId());
    	}
}
