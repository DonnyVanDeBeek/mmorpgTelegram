<?php
	//[NPC ESPLORAZIONE] DAHU
	class Npc101 extends Npc{
		private $npcId = 101;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();

			$Sasso = 109;
			$Ut = $this->getUtente();

			$scelteIniziali = new Keyboard();
			$scelteIniziali->push('Lascialo stare');
			if($Ut->hasTipoItem($Sasso))
				$scelteIniziali->push('Tiragli un sasso');

			switch($this->getFlag()){
				case 0:
					write("Vedi in lontananza un dahü.");
					$this->setKeyFlagStatus($scelteIniziali, 1, 18);
				break;

				case 1:
					switch($this->getText()){
						case 'Lascialo stare':
							write("Te ne vai ignorando il dahü\n");
							$this->setKeyFlagStatus(kMenuPrincipale(), 0, 0);
						break;

						case 'Tiragli un sasso':
							//Nel caso non abbia un sasso
							if(!$Ut->hasTipoItem($Sasso)){
								$msg .= "Scegli un'opzione da tastiera";
								$this->setKeyFlagStatus($scelteIniziali, 1, 18);
								break;
							}

							$Ut->togliItem($Sasso);

							write('Il dahü cade dalla montagna per tanti metri. Ti giri sperando che nessuno ti abbia visto');
							$this->setKeyFlagStatus(kMenuPrincipale(), 0, 0);
						break;

						default:
							write("Scegli un'opzione da tastiera");
							$this->setKeyFlagStatus($scelteIniziali, 1, 18);
					}
				break;
			}
		}
	}