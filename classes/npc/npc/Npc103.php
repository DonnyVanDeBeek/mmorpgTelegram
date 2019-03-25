<?php
	//[NPC ESPLORAZIONE]  RAGAZZINI POVERI CHE RUBANO AL MERCATO
	class Npc103 extends Npc{
		private $npcId = 103;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();

			$Ut = $this->getUtente();

			$scelteIniziali = new Keyboard();
			$scelteIniziali->push("Portali davanti alla giustizia");

			$soldiPerPagare = 10;
			if($Ut->getSoldi() >= $soldiPerPagare)
				$scelteIniziali->push('Paga il cibo per loro');

			$scelteIniziali->push('Minacciali di portarli alle autorità');

			switch($this->getFlag()){
				case 0:
					write("<b>Ragazzini Affamati</b>\n");
					write("Vedi dei ragazzini poveri che rubano al mercato.");
					$this->setKeyFlagStatus($scelteIniziali, 1, 18);
				break;

				case 1:
					switch($this->getText()){
						case 'Portali davanti alla giustizia':
							$soldi = 30;
							write("Ti allontani contando i soldi con dietro le urla di dolore dei ragazzini, sapendo di aver fatto la cosa giusta.\n");
							$Ut->giveSoldi($soldi);
							$Ut->notifyGiveSoldi($soldi);
							$this->setKeyFlagStatus(kMenuPrincipale(), 0, 0);
						break;

						case 'Paga il cibo per loro':
							//In caso non avessi abbastanza soldi
							if($Ut->getSoldi() < $soldiPerPagare){
								write("Scegli un'opzione da tastiera");
								$this->setKeyFlagStatus($scelteIniziali, 1, 18);
							}

							$soldi = $soldiPerPagare;
							$exp = 30;
							$B = new Buff();
							$B->setTarget($Ut);
							$B->setStat('SAGGEZZA');
							$B->setValue(50);
							$B->setTurni(5);

							$Ut->takeSoldi($soldi);
							$Ut->giveExp($exp);

							$Ut->notifyTakeSoldi($soldi);
							$Ut->notifyGiveExp($exp);
							$B->send();

							$this->setKeyFlagStatus(kMenuPrincipale(), 0, 0);
						break;

						case 'Minacciali di portarli alle autorità':
							$provaCarisma = 50;
							$cipolleMin = 2;
							$cipolleMax = 5;
							$Cipolla = 1;

							$carisma = $Ut->getTotalStat('CARISMA');

							$n = $carisma < $provaCarisma ? $cipolleMin : $cipolleMax;

							$Ut->giveItem($Cipolla, $n);

							write('I ragazzi ti danno '.$n.' cipolle.');

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