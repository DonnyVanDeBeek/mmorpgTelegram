<?php
	class Npc26 extends Npc{
		private $npcId = 26;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			//$msg = '<b>Mark Jankos</b>: ';
			$msg = '';

			$pozioni = new Keyboard();
			$pozioni->push('Non voglio nessuna pozione... grazie!');
			$pozioni->push('Pozione piccola della forza');
			$pozioni->push('Pozione piccola della magia');

			switch($this->getFlag()){
				case 0:
					$msg = '<b>Mark Jankos</b>: ';
					$msg .= 'Benvenuto nel negozio di pozioni dei fratelli Jankos!'."\n";
					if($this->getData('TIMES_TALKED') > 0) $msg .= 'Non è la prima volta che ci vediamo, o sbaglio?'."\n";
					$msg .= 'Ecco a te la lista delle pozioni che ti consiglio!'."\n\n";

					//LISTA
					$msg .= "Pozione piccola della forza - 10 Monete\n";
					$msg .= "Pozione piccola della magia - 10 Monete\n";

					$this->setFlag(1);
					$this->setKeyboard($pozioni);
					$this->getUtente()->setUtenteStatoId(18);
				break;

				case 1:
					switch($this->getText()){
						case 'Non voglio nessuna pozione... grazie!':
							$msg .= '<b>Mark Jankos</b>: ';
							$msg .= 'Nessun problema, prova da mio fratello, lui potrebbe avere ciò che cerchi!'."\n";
							$this->setFlag(0);
							$this->getUtente()->setUtenteStatoId(17);
							$this->setKeyboard(kNpc());
						break;

						case 'Pozione piccola della forza':
							$prezzo = 10;
							if($this->getUtente()->getUtenteSoldi() < $prezzo){
								$msg .= "Scusami tanto... ma non hai abbastanza denaro!";
								break;
							}

							$this->getUtente()->gainItem(6);
							$this->getUtente()->takeSoldi($prezzo);

							$msg .= $this->getUtente()->getMsg('GAIN_ITEM')."\n\n";
							$msg .= '<b>Mark Jankos</b>: ';
							$msg .= 'Una pozione che migliorerà la tua forza per qualche minuto! Ottima scelta!'."\n";
							$msg .= 'Serve altro?'."\n";
						break;

						case 'Pozione piccola della magia':
							$prezzo = 10;
							if($this->getUtente()->getUtenteSoldi() < $prezzo){
								$msg .= "Scusami tanto... ma non hai abbastanza denaro!";
								break;
							}

							$this->getUtente()->gainItem(7);
							$this->getUtente()->takeSoldi($prezzo);
							
							$msg .= $this->getUtente()->getMsg('GAIN_ITEM')."\n\n";
							$msg .= '<b>Mark Jankos</b>: ';
							$msg .= 'Una pozione che migliorerà la tua magia per qualche minuto! Scelta brillante!'."\n";
							$msg .= 'Serve altro?'."\n";
						break;

						default:
							$msg .= '<b>Mark Jankos</b>: ';
							$msg .= 'Non ho capito... potresti ripetere?';
							$this->setKeyboard($pozioni);
							$this->getUtente()->setUtenteStatoId(18);
					}
				break;
			}

			$this->addTimesTalked();
			write($msg);
		}
	}
