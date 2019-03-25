<?php
	//[NPC ESPLORAZIONE] SCAMBIO SULLA MONTAGNA
	class Npc107 extends Npc{
		private $npcId = 107;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();

			$StellaAlpina = 93;
			$Cipolla = 1;

			$Ut = $this->getUtente();

			$scelteIniziali = new Keyboard();
			$scelteIniziali->push('Accetta lo scambio');
			$scelteIniziali->push('Dagli le cipolle senza volere nulla in cambio');
			$scelteIniziali->push('Digli che non sei interessato');

			//frasi
			$Accetta = "Tiri fuori dalla saccoccia dieci cipolle e le rendi all'uomo in cambio del suo misterioso oggetto\n";
			$Rifiuta = "L'uomo, triste, se ne va blaterando che ora dovrà rinunciare alla sua scalata\n";
			$Beneficenza = "L'uomo ti guarda con occhi sognanti e si stupisce della tua gentilezza.\nPrende le cipolle e continua la sua scalata.\n";

			switch($this->getFlag()){
				case 0:
					write("<b>Scambio Sulla Montagna</b>\n");
					write("Incontri un uomo alto dai capelli bruni e dalla carnagione chiara. I suoi occhi grigi e vitrei ti scrutano.\nL'uomo si rivolge a te: \"Salve, stavo scalando la montagna quando sono rimasto senza cibo... ma quelle sono mica cipolle? Io vado matto per le cipolle! Ti va di darmene dieci in cambio di un oggetto che ho trovato qui in giro?\"");
					$this->setKeyFlagStatus($scelteIniziali, 1, 18);
				break;

				case 1:
					switch($this->getText()){
						case 'Accetta lo scambio':
							write($Accetta);
							$Ut->togliItem($Cipolla, 10);
							$Ut->giveItem($StellaAlpina);
							$Ut->initNotifyGiveItem();
							$Ut->notifyGiveItem($StellaAlpina);
							$this->setKeyFlagStatus(kMenuPrincipale(), 0, 0);
						break;

						case 'Dagli le cipolle senza volere nulla in cambio':
							write($Beneficenza);
							$exp = 50;
							$Ut->togliItem($Cipolla, 10);
							$Ut->giveExp($exp);
							$Ut->notifyGiveExp($exp);
							$this->setKeyFlagStatus(kMenuPrincipale(), 0, 0);
						break;

						case 'Digli che non sei interessato':
							write($Rifiuta);
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