<?php

namespace LUKAY207\PrivateChats;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class Loader extends PluginBase {
    use SingletonTrait;

    protected function onLoad(): void {
        self::setInstance($this);
    }

    protected function onEnable(): void {
        @mkdir($this->getDataFolder() . 'chats');
    }
}