<?php
	//[STORYLINE] 1 - INSEGUIMENTO
	class Npc127 extends Npc{
		private $npcId = 127;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();

			$Ut = $this->getUtente();
			$flag = $this->getFlag();
			$text = $this->getText();

			if($flag == 0){
				write($messaggioIniziale);
				$this->setKeyFlagStatus($kOpzioni1, 1, 18);
			}

			if($flag == 1){
				switch($text){
					case "":
						
					break;

					case "":
						
					break;

					case "":
						
					break;

					default:
						write("Scegli un'opzione da tastiera");
						$this->setKeyFlagStatus($kOpzioni1, 1, 18);
				}
			}
		}
	}