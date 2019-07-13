<?php

namespace Cmd;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);    
        $this->getLogger()->info(TextFormat::GREEN . "On");
    }
    public function onDisable() {
        $this->getLogger()->info(TextFormat::RED . "Off");
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "fa":
                if ($sender->hasPermission("fa.cmd")){
                     $this->Menu($sender);
                }else{     
                     $sender->sendMessage(TextFormat::RED . "You dont have permission!");
                     return true;
                }     
            break;         
            
         }  
        return true;                         
    }
   
    public function Menu($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) { 
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
            $sender->setHealth(20);
            $sender->sendMessage("§aYou have been healed!");
                break;
                    
                case 1:
                $sender->setFood(20);
                $sender->sendMessage("§aYou have been feed!");
                break;
            }
            
            
            });
            $form->setTitle("§9FeedAndHealUIPMMP");
            $form->addButton("Heal");
            $form->addButton("Feed");
            $form->addButton("Back");
            $form->sendToPlayer($sender);
            return $form;                                            
    }
 
                                                                                                                                                                                                                                                                                          
}