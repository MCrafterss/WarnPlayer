<?php
  namespace WarnPlayer;
  use pocketmine\plugin\PluginBase;
  use pocketmine\event\Listener;
  use pocketmine\utils\TextFormat as TF;
  use pocketmine\command\Command;
  use pocketmine\command\CommandSender;
  use pocketmine\command\CommandExecutor;
  use pocketmine\Player;
  class Main extends PluginBase implements Listener {
    public function onEnable() {
      $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
      if($cmd->getName() === "warn") {
        if(!(isset($args[0]) and isset($args[1]))) {
          $sender->sendMessage(TF::RED . "Error: not enough args. Usage: /warn <player> <reason>");
        } else {
          $sender_name = $sender->getName();
          $player = $this->getServer()->getPlayer($args[0]);
          $player_name = $player->getName();
          unset($args[0]);
          $reason = implode(" ", $args);
          $player->sendMessage(TF::RED . "You have been warned by " . $sender_name . " for " . $reason . "!");
          $this->getServer()->broadcastMessage(TF::YELLOW . $player_name . " was warned by " . $sender_name . " for " . $reason . "!");
          $sender->sendMessage(TF::GREEN . $player_name . " was warned for " . $reason . "!");
        }
      }
    }
  }
?>
