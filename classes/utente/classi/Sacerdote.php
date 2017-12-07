<?php
	Class Sacerdote extends Utente{
		
		public function __construct($UTENTE_ID){
			parent::__construct($UTENTE_ID);
		}
		
		public function useSkill($skill, $target = null){
			switch($skill){
					case 'Luce Divina':
						return $this->luceDivina();
				
					case 'Penitenza Del Peccatore':
						return $this->penitenzaDelPeccatore($target);
				default:
					return 'Skill sconosciuta';
			}
		}
		
		public function subisciDanno($dealer, $dmg){
			$dmg = $dmg - $this->getTotalStat('COSTITUZIONE');
			if($dmg < 0) $dmg = 1;
			$this->setHp($this->getHp() - $dmg);
			return $dmg;
		}
		
		public function heal($heal){
			$heal = $heal + $this->lvl;
			$this->setHp($this->getHp() + $heal);
			return $heal;
		}
		
		//Skills
		public function luceDivina(){
			//RECUPERA IL 10% DELLA VITA + 1% PER OGNI 100 SAGGEZZA, MASSIMO 30%
			$vitaBaseRecuperata = 10;
			$bonusSaggezza = intVal($this->getTotalStat('SAGGEZZA')/100);
			$vitaPerc = $vitaBaseRecuperata + $bonusSaggezza;
			$vitaPerc = ($vitaPerc > 30 ? 30 : $vitaPerc);
			$vitaEffettivaRecuperata = $this->getPercentualeStat('HP', 10);
			$vita = $this->heal($vitaEffettivaRecuperata);
			$msg = 'Hai recuperato '.$vita.' hp!';
			return $msg;
		}
		
		public function penitenzaDelPeccatore($target){
			//Infligge danni pari al 50% della saggezza + il 50% dell'intelligenza, buff all'intelligenza del 10% della saggezza per 100 secondi e infiniti turni
			if(is_null($target)) return $this->noTargetErr();
			$dmg = 0;
			$dmg = $dmg + $this->getPercentualeStat('SAGGEZZA', 50);
			$dmg = $dmg + $this->getPercentualeStat('INTELLIGENZA', 50);
			$de = $target->subisciDanno($this, $dmg);
			$bonusIntelligenza = $this->getPercentualeStat('SAGGEZZA', 10);
			$buff = new Buff($this->getId(), $this->getId());
			$buff->setIntelligenza($bonusIntelligenza);
			$buff->setTimeActive(100);
			$buff->setTimeTurnBased(999);
			$buff->send();
			$msg = 'Il peccaminoso '.$target->getNome().' subisce '.$de.' danni. La tua intelligenza aumenta di +'.$bonusIntelligenza.'!';
			return $msg;
		}
		
	}