<?php
	public function talk(){
			$this->addTimesTalked();
			$msg = '';
			$frase = array();

			$CuoreDiTroll = 101;
			$ReneDOrco = 85;
			$Muschio = 104;
			$AmpollaVuota = 105;

			$PozzMaggForza = 106;
			$PozzMaggCost = 107;

			$ricettaPozioneMaggioreForza = array();
			$ricettaPozioneMaggioreForza[0]['tipoItemId'] 	= $CuoreDiTroll;
			$ricettaPozioneMaggioreForza[0]['quantita'] 	= 1;
			$ricettaPozioneMaggioreForza[1]['tipoItemId'] 	= $Muschio;
			$ricettaPozioneMaggioreForza[1]['quantita'] 	= 1;
			$ricettaPozioneMaggioreForza[2]['tipoItemId'] 	= $AmpollaVuota;
			$ricettaPozioneMaggioreForza[2]['quantita'] 	= 1;

			$ricettaPozioneMaggioreCostituzione = array();
			$ricettaPozioneMaggioreCostituzione[0]['tipoItemId'] 	= $ReneDOrco;
			$ricettaPozioneMaggioreCostituzione[0]['quantita'] 		= 1;
			$ricettaPozioneMaggioreCostituzione[1]['tipoItemId'] 	= $Muschio;
			$ricettaPozioneMaggioreCostituzione[1]['quantita'] 		= 1;
			$ricettaPozioneMaggioreCostituzione[2]['tipoItemId'] 	= $AmpollaVuota;
			$ricettaPozioneMaggioreCostituzione[2]['quantita'] 		= 1;

			$menuPrincipale = new Keyboard();
			$menuPrincipale->push('Vattene');
			$menuPrincipale->push('Pozioni');

			$pozioni = new Keyboard();
			$pozioni->push('Torna Indietro');
			$pozioni->push('Pozione Maggiore Della Forza');
			$pozioni->push('Pozione Maggiore Della Costituzione');

			$creaAnnulla = new Keyboard();
			$creaAnnulla->push('Crea');
			$creaAnnulla->push('Annulla');

			switch($this->getFlag()){
				case 0:
					$msg .= "Entri nel laboratorio alchemico. Qui puoi creare pozioni e bombe alchemiche.";
					$this->setKeyFlagStatus($menuPrincipale, 1, 18);
				break;

				case 1:
					switch($this->getText()){
						case 'Vattene':
							$msg .= "Esci dal laboratorio alchemico.\n";
							$this->backToMenu(0);
						break;

						case 'Pozioni':
							$msg .= "Lista Pozioni";
							$this->setKeyFlagStatus($pozioni, 2, 18);
						break;

						default:
							$msg .= "Scegli un'opzione da tastiera";
							$this->setKeyFlagStatus($menuPrincipale, 1, 18);
					}
				break;

				case 2:
					switch($this->getText()){
						case 'Torna Indietro':
							$msg .= 'Tornando indietro...';
							$this->setKeyFlagStatus($menuPrincipale, 1, 18);
						break;

						case 'Pozione Maggiore Della Forza':
							$msg .= "Ricetta\n\n>Cuore di Troll\n>Muschio\n>Ampolla vuota\n";
							$this->setKeyFlagStatus($creaAnnulla, 106, 18);
						break;

						case 'Pozione Maggiore Della Costituzione':
							$msg .= "Ricetta\n\n>Rene d'orco\n>Muschio\n>Ampolla vuota\n";
							$this->setKeyFlagStatus($creaAnnulla, 107, 18);
						break;

						default:
							$msg .= "Scegli un'opzione da tastiera";
							$this->setKeyFlagStatus($menuPrincipale, 1, 18);
					}
				break;

				//Pozione maggiore della forza
				case 106:
					switch($this->getText()){
						case 'Crea':
							$onTrue = "Hai ottenuto una pozione maggiore della forza!";
							$onFalse = "Non hai gli oggetti necessari!";
							$item = array(
										'tipoItemId' => $PozzMaggForza, 
										'ingredienti' => $ricettaPozioneMaggioreForza
									);
							$res = $this->craftItem($item);
							$msg .= $res ? $onTrue : $onFalse;
							$this->setKeyFlagStatus($creaAnnulla, 106, 18);
						break;

						case 'Annulla':
							$msg .= "Lista Pozioni";
							$this->setKeyFlagStatus($pozioni, 2, 18);
						break;

						default:
							$msg .= "Scegli un'opzione da tastiera";
							$this->setKeyFlagStatus($menuPrincipale, 1, 18);
					}
				break;

				//Pozione maggiore della costituzione
				case 107:
					switch($this->getText()){
						case 'Crea':
							$onTrue = "Hai ottenuto una pozione maggiore della costituzione!";
							$onFalse = "Non hai gli oggetti necessari!";
							$item = array(
										'tipoItemId' => $PozzMaggCost, 
										'ingredienti' => $ricettaPozioneMaggioreCostituzione
									);
							$res = $this->craftItem($item);
							$msg .= $res ? $onTrue : $onFalse;
							$this->setKeyFlagStatus($creaAnnulla, 107, 18);
						break;

						case 'Annulla':
							$msg .= "Lista Pozioni";
							$this->setKeyFlagStatus($pozioni, 2, 18);
						break;

						default:
							$msg .= "Scegli un'opzione da tastiera";
							$this->setKeyFlagStatus($menuPrincipale, 1, 18);
					}
				break;
			}

			write($msg);
		}