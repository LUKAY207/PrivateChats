<?php

namespace LUKAY207\PrivateChats\chat\manager;

use JsonException;
use LUKAY207\PrivateChats\chat\Chat;
use LUKAY207\PrivateChats\Loader;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;

class ChatManager {
    use SingletonTrait;

    private array $chats = [];

    /**
     * @throws JsonException
     */
    public function init(): void {
        foreach (scandir(Loader::getInstance()->getDataFolder() . '/chats') as $value) {
            $data = new Config(Loader::getInstance()->getDataFolder() . '/chats/' . $value . '.json', Config::JSON);

            $chatObjectArray = json_decode($data->get(0), true);
            $chatObject = new Chat($chatObjectArray['name'], $chatObjectArray['owner'], $chatObjectArray['involved']);

            $this->chats[$chatObject->getName()] = $chatObject;
        }
    }

    public function getChats(): array {
        return $this->chats;
    }
}