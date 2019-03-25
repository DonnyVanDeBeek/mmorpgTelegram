<?php
	class Skill137 extends Skill{
		//REAZIONE ALCHEMICA: DALL'ARSENICO ALL'ORO
		private $id = 137;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Equips = $this->getEquips();

			write($Caster->getNome().' effettua la reazione alchemica dall\'arsenico all\'oro!'."\nChiunque sia avvelenato subirà ora una bruciatura!");

			$DannoBruciatura = $Caster->getTotalStat('MAGIA') * 0.3;
			$turni = 5;

			$Targets = $Caster->getTargetsInRange(999);

			$Bruciatura = 1;
			$Avvelenamento = 4;

			$n = count($Targets);
			for($i = 0; $i < $n; $i++){
				$Tar = &$Targets[$i];
				if($Tar->hasTipoOvertime($Avvelenamento)){
					$Tar->removeOvertime($Avvelenamento);
					$Tar->giveOverTime($Bruciatura, $DannoBruciatura, $turni);
				}
			}

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}
