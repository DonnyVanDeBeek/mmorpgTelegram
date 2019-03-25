<?php
	//SAL VATHOR ARAN ZHUL
	class Npc97 extends Npc{
		private $npcId = 97;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();

			//Variabili
			$SpadaDiFerro = 13;
			$ScudoDiFerro = 17;

			$AttaccoBaseSpada = 0;

			$Ut = $this->getUtente();

			$opzioniIniziali = new Keyboard();
			$opzioniIniziali->push('Afferra la spada');

			//frasi
			$benvenuto = "<b>???</b>: Salve, benvenuto nella mia dimora. Io sono ".$this->getNome().".\n\n".$this->getSpeakNome().' so che sei confuso e hai molte domante. Non temere, presto molti dei tuoi dubbi troveranno risposta. Prima, però, ho bisogno che tu faccia come dico io. Osserva questa spada. Forza, afferrala, non morde!'."\n\nCon un movimento armonioso, l'uomo lancia la spada verso di te, cosa fai?\n";
			
			switch($this->getFlag()){
				case 0:
					$write($benvenuto);
					$this->setKeyFlagStatus($opzioniIniziali, 1, 18);
				break;

				case 1:
					switch($this->getText()){
						case 'Afferra la spada':
							write("Agguanti la spada al volo.\n");

							$Ut->giveItem($SpadaDiFerro);
							$Ut->initNotifyGiveItem();
							$Ut->notifyGiveItem($SpadaDiFerro);

							write($this->getSpeakNome().' Bella presa! Adesso ti insegno come usarla. Ripeti quello che faccio io'."\n\nL'uomo inizia a fare vari movimenti con la sua spada, quasi volesse tagliare l'aria. Imiti ogni suo movimento.";

							$Ut->learnSkill($AttaccoBaseSpada)
							$Ut->initNotifyLearnSkill();
							$Ut->notifyLearnSkill($AttaccoBaseSpada);
							$this->backToMenu(0);
						break;

						default:
							$msg .= "Scegli un'opzione da tastiera";
							$this->setKeyFlagStatus($opzioniIniziali, 1, 18);
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
		}
	}