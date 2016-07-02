<?php
/*
   Copyright 2016 BurrowPvP
   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at
       http://www.apache.org/licenses/LICENSE-2.0
   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
limitations under the License.
*/
namespace SuperJump\tasks;

use pocketmine\scheduler\PluginTask;
use Secret\Main;

class CountdownTask extends PluginTask{
  /** @var Main */
  private $plugin;
  
  public $seconds = 20;
  
  public function __construct(Main $plugin){
    parent::__construct($plugin);
    $this->plugin = $plugin;
  }
  
  public function onRun($currentTick){
     $this->seconds -= 1;
     foreach($this->plugin->getServer()->getPlayer($this->plugin->players) as $player){
        if($this->seconds == 1){
           switch(mt_rand(1, 5)){
              case 1:
                 // map 1
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
           ServerScheduler::cancelTask($this->getTaskId());
        }
     }
  }
}
