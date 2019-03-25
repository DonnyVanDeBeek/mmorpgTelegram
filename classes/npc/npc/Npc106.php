<?php
	//[NPC ESPLORAZIONE] SCEGLI UN FUNGO
	class Npc106 extends Npc{
		private $npcId = 106;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();

			$AmanitaMuscaria = 64;
			$Oohlompa = 76;
			$MazzaTamburo = 65;

			$Ut = $this->getUtente();

			$scelteIniziali = new Keyboard();
			$scelteIniziali->push('Amanita Muscaria');
			$scelteIniziali->push('Oohlompa');
			$scelteIniziali->push('Mazza Tamburo');

			switch($this->getFlag()){
				case 0:
					write("<b>Questione Di Funghi</b>\n");
					write("Mentre esplori la tana dei funguomini il tuo occhio scorge tre funghi dai colori meravigliosi sul terreno.\nHai già in mente di fare scorpacciata di funghi, quando senti dei passi in lontananza, devono essere i funguomini.\nHai tempo solo per prenderne uno prima di scappare.\nQuale scegli?");
					$this->setKeyFlagStatus($scelteIniziali, 1, 18);
				break;

				case 1:
					write("Afferri il fungo e scappi a nasconderti in un altro punto della tana\n");
					$Ut->initNotifyGiveItem();
					switch($this->getText()){
						case 'Amanita Muscaria':
							$Ut->giveItem($AmanitaMuscaria);
							$Ut->notifyGiveItem($AmanitaMuscaria);
							$this->setKeyFlagStatus(kMenuPrincipale(), 0, 0);
						break;

						case 'Oohlompa':
							$Ut->giveItem($Oohlompa);
							$Ut->notifyGiveItem($Oohlompa);
							$this->setKeyFlagStatus(kMenuPrincipale(), 0, 0);
						break;

						case 'Mazza Tamburo':
							$Ut->giveItem($MazzaTamburo);
							$Ut->notifyGiveItem($MazzaTamburo);
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