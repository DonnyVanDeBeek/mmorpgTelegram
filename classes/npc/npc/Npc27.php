<?php
	class Npc27 extends Npc{
		private $npcId = 27;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			//$msg = '<b>Mark Jankos</b>: ';
			$msg = '';

			$pozioni = new Keyboard();
			$pozioni->push('No, grazie!');
			$pozioni->push('Pozione piccola del caos');

			switch($this->getFlag()){
				case 0:
					$msg = '<b>Johnny Jankos</b>: ';
					$msg .= 'Benvenuto... nel negozio di pozioni dei fratelli Jankos!'."\n";
					if($this->getData('TIMES_TALKED') > 0) $msg .= 'Non è la prima volta che ci vediamo, o sbaglio?'."\n";
					$msg .= 'Ho una sola pozione da darti... bada bene, è una pozione piccola del caos! Potrebbe migliorarti o peggiorarti... ma dopo cinque minuti passa tutto! Accetti il rischio? Cinquanta monete!'."\n\n";

					$this->setFlag(1);
					$this->setKeyboard($pozioni);
					$this->getUtente()->setUtenteStatoId(18);
				break;

				case 1:
					switch($this->getText()){
						case 'No, grazie!':
							$msg .= '<b>Johnny Jankos</b>: ';
							$msg .= 'Mammoletta, prova con le pozioni sicure di mio fratello! Quello smidollato!'."\n";
							$this->setFlag(0);
							$this->getUtente()->setUtenteStatoId(17);
							$this->setKeyboard(kNpc());
						break;

						case 'Pozione piccola del caos':
							$prezzo = 50;
							if($this->getUtente()->getUtenteSoldi() < $prezzo){
								$msg .= "Scusami tanto... ma non hai abbastanza denaro!";
								break;
							}

							$this->getUtente()->gainItem(8);
							$this->getUtente()->takeSoldi($prezzo);

							$msg .= $this->getUtente()->getMsg('GAIN_ITEM')."\n\n";
							$msg .= '<b>Johnny Jankos</b>: ';
							$msg .= 'Divertiti con il rischio! Fammi sapere se ti succ... a presto!!'."\n";
							$msg .= 'Serve altro?'."\n";
						break;

						default:
							$msg .= '<b>Johnny Jankos</b>: ';
							$msg .= 'Ma parla come mangi!';
							$this->setKeyboard($pozioni);
							$this->getUtente()->setUtenteStatoId(18);
					}
				break;
			}

			$this->addTimesTalked();
			write($msg);
		}
	}
