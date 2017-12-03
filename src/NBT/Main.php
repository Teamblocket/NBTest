<?php

namespace NBT;

use pocketmine\item\Item;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

use pocketmine\Player;

use pocketmine\event\player\{PlayerJoinEvent, PlayerInteractEvent};

use pocketmine\nbt\tag\{StringTag, CompoundTag};

class Main extends PluginBase implements Listener{
  
  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }
  
  public function onJoin(PlayerJoinEvent $ev){
    $item = Item::get(276, 0, 1);
    $nbt = $item->getNamedTag() ?? new CompoundTag("", []);
    $nbt->test = new StringTag("test", "hey");
    $item->setNamedTag($nbt);
    $ev->getPlayer()->getInventory()->setItemInHand($item->setCustomName('Test Sword'));
  }
  
  public function onInteract(PlayerInteractEvent $ev){
    $p = $ev->getPlayer();
    $item = $p->getInventory()->getItemInHand();
    if(isset($item->getNamedTag()->test)) {
      $test = $item->getNamedTag()->test;//"hey"
      $p->sendMessage('NBT TAGS WORK!!!!!!!!!');
    }
}
