<?php
	Class Guerriero extends Utente{
		private $target;

		public function __construct($UTENTE_ID){
			parent::__construct($UTENTE_ID);
		}

		public function useSkill($skill, $target = null){
			$this->target = $target;
			if(!$skill->doesExist())
				return $skill->getSkillNome() . ' non è una skill esistente!';
			if($skill->getSkillClasseId() != $this->utenteClasseId)
				return $skill->getSkillNome() . ' non è una skill disponibile per la tua classe.';
			if($skill->getSkillLivelloSblocco() > $this->utenteLevel)
				return 'Non hai ancora sbloccato ' . $skill->getSkillNome() . '!';

			return $this->{'Skill_'.$skill->getSkillNum()}($skill);
		}

		public function subisciDanno($dealer, $dmg){
			//$dmg = $dmg - $this->getTotalStat('COSTITUZIONE');
			$perc = log($this->getTotalStat('COSTITUZIONE'), 100000) * 100;
			$dmg = intVal($dmg * ((100 - $perc) / 100));
			if($dmg < 0) $dmg = 1;
			$this->setUtenteHp($this->getUtenteHp() - $dmg);

			if(rand(0,100) == 50){
				$dealer->subisciDanno(9999);
				$this->sendMessage('Grazie al colpo subito vai in modalità berserk e aggredisci ' . $dealer->getNome());
			}

			return $dmg;
		}


		public function Skill_1($skill){
			//Doppio Attacco
			$target = $this->target;
			if(is_null($target)) return $this->noTargetErr();
			$dmg = 0;
			$dmg += intVal(rand($this->getTotalStat('FORZA') * 0.1, $this->getTotalStat('FORZA')));
			$dmg += intVal(rand($this->getTotalStat('FORZA') * 0.1, $this->getTotalStat('FORZA')));
			$danniEffettivi = $target->subisciDanno($this, $dmg);
			$msg = 'Sorprendi ' . $target->getNome() . ' con due attacchi consecutivi per un totale di '. $danniEffettivi . ' danni!';
			return $msg;
		}

		public function Skill_2($skill){
			//Colpo Di Precisione
			$target = $this->target;
			if(is_null($target)) return $this->noTargetErr();
			$dmg = intVal($target->getTotalStat('COSTITUZIONE')/50) - $this->getTotalStat('FORZA');
			if($dmg >= 0) $dmg = -1;
			$target->subisciDanno($this, $dmg * 2);
			return 'Studi '.$target->getNome().' attentamente per carpirne i punti deboli. Riesci a ferirlo gravemente: '.$dmg * -1 . ' danni!';
		}

		public function Skill_3($skill){
			//Fendente Difensivo
			$target = $this->target;
			if(is_null($target)) return $this->noTargetErr();
			$dmg = $this->getTotalStat('FORZA');
			$de = $target->subisciDanno($this, $dmg);
			$bonusCost = 5 * $this->utenteLevel;
			$buff = new Buff($this->utenteId, $this->utenteId);
			$buff->setCostituzione($bonusCost);
			$buff->setTimeActive(100);
			$buff->setTimeTurnBased(3);
			$buff->setSkillId($skill->getSkillId());
			$buff->send();
			$msg = 'Attacchi ' . $target->getNome() . ' infliggendogli ' . $de . ' danni. La tua costituzione aumenta di + ' . $bonusCost;
			return $msg;
		}

		/*

		public function colpoDiPrecisione($target){
			if(is_null($target)) return $this->noTargetErr();
			$dmg = intVal($target->getTotalStat('COSTITUZIONE')/50) - parent::getTotalStat('FORZA');
			if($dmg >= 0) $dmg = -1;
			$target->setHp($target->getHp() - ($dmg * -1));
			return 'Studi '.$target->getNome().' attentamente per carpirne i punti deboli. Riesci a ferirlo gravemente: '.$dmg * -1 . ' danni!';
		}

		public function fendenteDifensivo($target){
			if(is_null($target)) return $this->noTargetErr();
			$dmg = $this->getTotalStat('FORZA');
			$de = $target->subisciDanno($this, $dmg);
			$bonusCost = 5 * $this->lvl;
			$buff = new Buff($this->id, $this->id);
			$buff->setCostituzione($bonusCost);
			$buff->setTimeActive(100);
			$buff->setTimeTurnBased(3);
			$buff->send();
			$msg = 'Attacchi ' . $target->getNome() . ' infliggendogli ' . $de . ' danni. La tua costituzione aumenta di + ' . $bonusCost;
			return $msg;
		}
		*/
	}
