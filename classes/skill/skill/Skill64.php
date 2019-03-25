<?php
	class Skill64 extends Skill{
		//ANNEBBIARE VISUALE
		private $id = 64;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();

			write($Caster->getNome() . " tenta di annebbiare la visuale di " . $Target->getNome() . " con un incantesimo!" . "\n");

			$magia = $Caster->getTotalStat('MAGIA');
			$slvma = $Target->getTotalStat('SALVAMAGIA');

			if(Functions::diceRoll($magia) > Functions::diceRoll($slvma)){
				write('L\'incantesimo ha effetto!');
				$turni = 3;
				$value = $Target->getTotalStat('PRECISIONE') * 0.6;
				$value *= -1;
				$Target->giveBuff('PRECISIONE', $value, $turni);
			}else{
				write('L\'incanto ha fallito. Non succede nulla!');
			}


			$this->startCooldown($this->getCooldown());
			
			return true;
		}
	}