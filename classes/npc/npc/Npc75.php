<?php
	class Npc75 extends Npc{
		//Gnomo Bruno
		private $npcId = 75;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();
			//$msg = '<b>Gnomo Bruno</b>: ';
			$msg = '';

			$Tu = $this->getUtente();

			$aCapo = "\n";
			$appenaGliParli = "Ehilà ragazzo, se vuoi sopravvivere nei boschi qua nei dintorni se nel posto giusto! Come ti posso aiutare?";

			$pozioni = new Keyboard();
			$pozioni->push('Mi servirebbero delle informazioni su questo bosco');
			$pozioni->push('Mi mostri la merce');
			$pozioni->push('Non ho bisogno di nulla, grazie!');

			//$this->getUtente()->hasTalkedToNpc(76);

			if($Tu->hasTalkedToNpc(76)){
				$pozioni->push('Lei conosce un tale gnomo Ivano?');
			}

			switch($this->getFlag()){
				case 0:
					$msg .= $appenaGliParli;

					$this->setFlag(1);
					$this->setKeyboard($pozioni);
					$this->getUtente()->setUtenteStatoId(18);
				break;

				case 1:
					switch($this->getText()){
						case 'Mi servirebbero delle informazioni su questo bosco':
							$msg .= '<b>Gnomo Bruno</b>: ';
							$msg .= 'Nessun problema, prova da mio fratello, lui potrebbe avere ciò che cerchi!'."\n";
							$this->setFlag(1);
							$this->setKeyboard($pozioni);
							$this->getUtente()->setUtenteStatoId(18);
							
						break;

						case 'Mi mostri la merce':
							/*
							$msg .= "Qua offriamo strumenti di sopravvivenza e provviste per ogni esploratore!\n corda - 4 moneta\n acciarino - 8 monete\n ascia gnomica - 65 monete\n cartina sbiadita - 22 monete";

							$merce = new Keyboard();
							$merce->push('Corda');
							$merce->push('Merce');


							$this->setFlag(3);
							$this->setKeyboard($merce);
							$this->getUtente()->setUtenteStatoId(18);
							*/

							$this->setFlag(0);
							$this->setKeyboard($pozioni);
							$this->getUtente()->setUtenteStatoId(18);
						break;

						case 'Lei conosce un tale gnomo Ivano?':
							$msg .= 'Lo gnomo ti sembra nervoso e risponde evasivamente di non averlo mai sentito e che non può ricordarsi il nome di tutta la gente che viene da lui'."\n";

							$pozioni = new Keyboard();
							$pozioni->push('Insisti');
							$pozioni->push('Cambia argomento');
							$this->setFlag(2);
							$this->setKeyboard($pozioni);
							
						break;

						case 'Non ho bisogno di nulla, grazie!':
							$msg .= 'Torni a trovarmi quando vuole';
							$this->setFlag(0);
							$this->getUtente()->setUtenteStatoId(17);
							$this->setKeyboard(kNpc());
						break;

						default:
							$msg .= '<b>Gnomo Bruno</b>: ';
							$msg .= 'Non ho capito... potresti ripetere?';
							$this->setFlag(1);
							$this->setKeyboard($pozioni);
							$this->getUtente()->setUtenteStatoId(18);
					}
				break;

				case 2:
					switch($this->getText()){
						case 'Insisti':
							$carismaProva = 150;
							$tuoCarisma = $Tu->provaDi('CARISMA');

							if($tuoCarisma >= $carismaProva){
								$msg .= 'Capisci che lo gnomo nasconde qualcosa e con la tua dialettica lo convinci a sputare il rospo'."\n\n";
								$msg .= '<b>Gnomo Bruno</b>: ';
								$msg .= 'Sì... lo conosco! Adesso non ti dirò nulla perché non abbiamo ancora creato la quest. Se vuoi lamentarti vai da quella grande donnaccia della Giorgia Meloni';
							}else{
								$msg .= 'Ah! Brutto rompiscatole! Fuori dalla mia proprietà! Per un po\' non voglio vedere la tua faccia!';
							}

							$this->setFlag(0);
							$this->getUtente()->setUtenteStatoId(17);
							$this->setKeyboard(kNpc());
						break;

						case 'Cambia argomento':
							$msg .= '<b>Gnomo Bruno</b>: ';
							$msg .= 'Bene, tornando a noi...';

							$this->setFlag(1);
							$this->getUtente()->setUtenteStatoId(18);
							$this->setKeyboard($pozioni);
						break;
					}
				break;
			}

			write($msg);
		}
	}
