<?php
	class Skill105 extends Skill{
		//PIANTO LACONICO
		private $id = 105;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " piange ininterrottamente mettendo a dura prova il coraggio di " . $Target->getNome()."\n");

			$provaSaggezza = 50;

			$saggezza = $Target->getTotalStat('SAGGEZZA');

			if($provaSaggezza > $saggezza){
				write($Target->getNome().' se la fa sotto!');

				$turni = 4;
				$min = -50;
				$max = -30;

				$stat = array('FORZA', 'DESTREZZA', 'MAGIA', 'SAGGEZZA');
				$n = count($stat);
				for($i = 0; $i < $n; $i++){
					$Target->giveBuff($stat[$i], rand($min,$max), $turni);	
				}
				
			}else{
				write($Target->getNome().' rimane indifferente.');
			}

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}