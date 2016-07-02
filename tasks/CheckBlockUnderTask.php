<?php

namespace Secret\tasks;

use pocketmine\scheduler\PluginTask;
use Secret\Main;

class CheckBlockUnderTask extends PluginTask{
  /** @var Main */
  private $plugin;
  
  public function __construct(Main $plugin){
    parent::__construct($plugin);
    $this->plugin = $plugin;
  }
  
  public function onRun($currentTick){
    
  }
  
}
