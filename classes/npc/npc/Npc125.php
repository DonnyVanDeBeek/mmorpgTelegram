<?php
	//HARUGH IL COLOSSO
	class Npc125 extends Npc{
		private $npcId = 125;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();

			$Ut = $this->getUtente();
			$ScudoSulNaso = 94;

			$flag = $this->getFlag();
			$text = $this->getText();

			$prezzo = 100;

			$opzioniIniziali = new Keyboard();
			if($Ut->getSoldi() >= $prezzo)
				$opzioniIniziali->push('Paga Harugh');
			$opzioniIniziali->push('Rifiuta');

			$intro = "Un uomo di corpuratura imponente siede sull letto a baldacchino. Non appena ti vede inizia a parlarti con una voce profonda\n\n".$this->getSpeakNome()." Sei anche tu qui per chiedermi di insegnartelo? Mi dispiace, non ti insegnerò un bel niente se non in cambio di $prezzo monete. Sei disposto a pagare?";

			$paga = $this->getSpeakNome().' Mhhh, sembrano autentiche, molto bene.'."\n\nHarugh estrae da sotto il letto un enorme scudo, brandendolo.\nSubito dopo, sferra un colpo dalla potenza inaudita verso il muro utilizzando lo scudo.\n\n".$this->getSpeakNome()." Se riesci a imprimergli la potenza giusta il nemico potrebbe rimanere di stucco. Mi raccomando, mira al naso.\n";

			$rifiuta = $this->getSpeakNome()." Come preferisci. Se cambi idea mi trovi qui. Se non ci sono, chiedi all'oste.\n";

			$conosceSkill = $this->getSpeakNome()." Sembra che tu conosca già ciò che voglio insegnarti. Mi tengo le monete per il disturbo, smamma!\n";

			if($flag == 0){
				write($intro);
				$this->setKeyFlagStatus($opzioniIniziali, 1, 18);
			}

			if($flag == 1){
				if($text == 'Paga Harugh'){
					if($Ut->togliSoldi($prezzo)){
						if($Ut->learnSkill($ScudoSulNaso, false)){
							write($paga);
							$Ut->initNotifyLearnSkill();
							$Ut->notifyLearnSkill($ScudoSulNaso);
						}
						else
							write($conosceSkill);
						$this->backToMenu(2);
					}else{
						write('Non disponi di sufficiente denaro.');
						$this->backToMenu(0);
					}
				}

				if($text == 'Rifiuta'){
					write($rifiuta);
					$this->backToMenu(0);
				}
			}

			if($flag == 2){
				$this->speak();
			}
		}
	}