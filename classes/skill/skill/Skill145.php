<?php
	class Skill145 extends Skill{
		//MELODIA FLAUTO: CURA BANDITI
		private $id = 145;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();

			write($Caster->getNome() . " suona una melodia con poteri curativi sui banditi!". "\n");

			$Bandito = 2;
			$Targs = $Caster->getTargetsInRange(999);
			$n = count($Targs);
			for($i = 0; $i < $n; $i++){
				$T = &$Targs[$i];
				if($T->getCategoria() == $Bandito){
					$heal = $T->getTotalStat('HP') * 0.25; 
					$T->heal($heal);
				}
			}

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}