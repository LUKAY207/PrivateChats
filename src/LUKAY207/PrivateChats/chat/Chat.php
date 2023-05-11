<?php

namespace LUKAY207\PrivateChats\chat;

use JsonException;
use LUKAY207\PrivateChats\Loader;
use pocketmine\player\Player;
use pocketmine\utils\Config;

class Chat {

    /**
     * @var string $name
     */
    private string $name;
    /**
     * @var Player $owner
     */
    private Player $owner;
    /**
     * @var Player[] $involved
     */
    private array $involved;

    /**
     * @param string $name
     * @param Player $owner
     * @param Player[] $involved
     * @throws JsonException
     */
    public function __construct(string $name, Player $owner, array $involved = [$owner]) {
        $this->name = $name;
        $this->owner = $owner;
        $this->involved = $involved;

        $this->saveData();
    }

    /**
     * @return void
     * @throws JsonException
     */
    private function saveData(): void {
        $data = new Config(Loader::getInstance()->getDataFolder() . '/chats/' . $this->name . '.json', Config::JSON);
        $data->set(0, $this);
        $data->save();
        $data->reload();
    }

    public function getName(): string {
        return $this->name;
    }

    public function getOwner(): Player {
        return $this->owner;
    }

    public function getInvolved(): array {
        return $this->involved;
    }

    /**
     * @throws JsonException
     */
    public function addInvolved(Player $player): void {
        $this->involved[] = $player;
        $this->saveData();
    }
}