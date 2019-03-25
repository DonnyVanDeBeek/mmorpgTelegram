<?php
	//VESCOVO URIEL
	class Npc56 extends Npc{
		private $npcId = 56;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();

			$text = $this->getText();
			$flag = $this->getFlag();
			$Ut = $this->getUtente();

			$SacraSpada = 1;
			$gildaId = $Ut->isInGilda();

			if($gildaId == $SacraSpada){
				write($this->getSpeakNome().' ti troverai bene nella Sacra Spada, parola mia!');
				$this->backToMenu(0);
				return false;
			}

			if($gildaId !== false){
				write($this->getSpeakNome().' è un vero peccato che tu sia occupato! La gilda Sacra Spada ti avrebbe accolto a mani aperte, credimi!');
				$this->backToMenu(0);
				return false;
			}

			$keyOpt = new Keyboard();
			$keyOpt->push("Unisciti alla gilda Sacra Spada");
			$keyOpt->push("Rifiuta invito");

			if($flag == 0){
				write($this->getSpeakNome().' Salve, sei per caso in cerca di una gilda? Noi <b>Sacra Spada</b> siamo una gilda molto rinomata da queste parti, sai? Che ne dici, sei dei nostri?');
				$this->setKeyFlagStatus($keyOpt, 1, 18);
			}

			if($flag == 1){
				switch ($text) {
					case 'Unisciti alla gilda Sacra Spada':
						$Ut->lasciaGilda();
						$Ut->entraGilda($SacraSpada);
						write($this->getSpeakNome().' Hai fatto la scelta giusta, lasciatelo dire! Benvenuto nei <b>Sacra Spada</b>!');
						$this->backToMenu(0);
						break;

					case 'Rifiuta invito':
						write($this->getSpeakNome().' Come desideri, se ci ripensi io sono sempre qui! A presto.');
						$this->backToMenu(0);
						break;

					default:
						# code...
						break;
				}
			}
		}
	}
